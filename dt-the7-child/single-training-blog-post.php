<?php
/**
 * Single template for training blog
 *
 */

defined( 'ABSPATH' ) || exit;

get_header( 'single' );
?>

<?php do_action( 'presscore_before_main_container' ); ?>

<?php if ( presscore_is_content_visible() ) : ?>

<div id="main" class="sidebar-none sidebar-divider-off">

	<?php do_action( 'presscore_main_container_begin' ); ?>

	<div class="main-gradient"></div>
	<div class="wf-wrap">
	<div class="wf-container-main">

	<?php do_action( 'presscore_before_content' ); ?>

<?php endif ?>

			<div id="content" class="content" role="main">

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php
						the_content();
						?>

					</article>

			</div><!-- #content -->

<?php
get_footer();
?>
