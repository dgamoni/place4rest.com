<?php
/**
 * Template Name: Add place
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

if ( is_user_logged_in() || current_user_can('publish_posts') ) { // Execute code if user is logged in
    acf_form_head();
    wp_deregister_style( 'wp-admin' );
}

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper-map" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'loop-templates/content', 'page-addplace' ); ?>


					<?php endwhile; // end of the loop. ?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->


<?php get_footer(); ?>
