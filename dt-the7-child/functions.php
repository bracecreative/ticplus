<?php
/**
 * Your code here.
 *
 */
 
 add_action('admin_footer', 'my_admin_footer_function', 1);
function my_admin_footer_function() {
	$currentScreen = get_current_screen();
	if($currentScreen->base == "nav-menus"){
		echo '<div id="optionsframework-search"></div>';
		
	}
}

@include_once get_stylesheet_directory().'/custom/calendar.php';

// widget area for blog event single pages

register_sidebar( array(
	'name' => __( 'Sidebar for Blog Events', 'ticplus' ),
	'id' => 'sidebar-blog-events',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>'
));

// widget area for training blog single pages

register_sidebar( array(
	'name' => __( 'Sidebar for Training Blog', 'ticplus' ),
	'id' => 'sidebar-training-blog',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle">',
	'after_title' => '</h3>'
));