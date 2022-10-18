<?php


//shortcode to do the calendar
add_shortcode( 'sugar_calendar',

  function( $atts ) {

    $out = '';
    foreach(['limit','debug','history','template','type'] as $v) {
      $$v = $atts[$v];
    }

    $types = [  //array of post types
      'event'     => 'date-for-this-event',
      'training'  => 'start-date-for-this-training-event'
    ];
    if( !in_array($type,array_keys($types)) ) {
      $type = 'event';
    }

    if(!is_numeric($limit)) $limit=4;
    
    if( !in_array($template,range(1,99)) ) $template = 'default-'.$type;
    $template_path = __DIR__.'/calendar_templates/';
    $template_file = $template_path.$template.'.php';

    if( !file_exists( $template_file ) ) $template_file = $template_path.'default.php';

    $debug = $_GET['jps_debug'];  //overrides shortcode att

    if($debug==3) { echo '<pre>'; print_r($atts); echo '<hr>'.$template_file; die; }

    $args = [
      'post_type'       => $type.'-date',
      'posts_per_page'  => -1,
      'orderby'         => 'meta_value',
      'meta_key'        => 'wpcf-'.$types[$type],
      'order'           => 'asc',
    ];

    global $post;
    $my_query = new WP_Query($args);
    if($debug == 2) { echo '<pre>'; print_r($my_query); die; }
    $count=0;

    $calendar = [];

    while ($my_query->have_posts()) {
        $my_query->the_post();

        $date_valid = false;
        $date = (int) trim( (string) get_post_meta($post->ID, 'wpcf-'.$types[$type], true) );
        if( is_numeric($date) && $date > 0 ) $date_valid = true;  //assuming that 0 is invalid

        if( $limit == -1 || $count < $limit ) {
            if(!$history && $date_valid) {
              if( $date < strtotime("today") ) {
                  continue;
              }
            }
            $year = date('Y',$date) ?: 0;
            $month = date('M',$date) ?: 0;

            $post->title = get_the_title();
            $post->event_date = $date;
            $post->event_url = get_post_meta($post->ID,'wpcf-'.$type.'-url',true);
            $calendar[ $year ][ $month ][] = $post;

            $count++;
        } else break;
    }
    wp_reset_postdata();

    $out = '';
    ob_start();

    echo PHP_EOL.'<!-- calendar start -->'.PHP_EOL;

    if($debug == 1) {
      echo '<pre>';
      print_r($calendar);
    } else {

      @include_once $template_file;

    }
    echo PHP_EOL.'<!-- calendar end -->'.PHP_EOL;
    $out = ob_get_contents();
    ob_end_clean();

    return $out;

  } 
);

/*
if(isset($_GET['jps'])) {
  add_action('wp_footer', function() {
    echo do_shortcode('[sugar_calendar limit="20" history="1"]');
  });
}
*/