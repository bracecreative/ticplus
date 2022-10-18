<?php
/**
 * Single template for event blog
 *
 */

defined( 'ABSPATH' ) || exit;

get_header( 'single' );
?>

<?php do_action( 'presscore_before_main_container' ); ?>

<?php if ( presscore_is_content_visible() ) : ?>

<div id="main" class="sidebar-right sidebar-divider-off">

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

				<?php
				comments_template( '', true );
				?>

			</div><!-- #content -->

			<aside id="sidebar">
					
					<div class="sidebar-content">
					
						<?php if ( is_active_sidebar( 'sidebar-blog-events' ) ) : ?>

							<?php dynamic_sidebar( 'sidebar-blog-events' ); ?>

						<?php endif; ?>
						
					</div>
				
			</aside>

<?php
get_footer();
?>
