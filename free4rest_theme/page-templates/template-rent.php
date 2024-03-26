<?php
/**
 * Template Name: Rent
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper-map" id="full-width-page-wrapper">

	<div class="full_header">
	
		<header class="container">
			<h1 class="entry-title"><?php echo get_the_title( get_the_ID() ); ?></h1>
		</header>


		<div class="rent_bxslider">
		 
			<?php 
			$images = get_field('rent_slider');
			$size = 'full'; // (thumbnail, medium, large, full or custom size)
			$params_news_img = array( 'width' => 1300, 'height' => 720 );

			foreach( $images as $key=>$image ): ?>
				<div class="fit-image_rent" style="background-image: url(<?php echo $image['url']; ?>);" >
		        	<div class="slider_text">
		        		<span class="slider_caption cap-<?php echo $key; ?>"><?php echo $image['caption']; ?></span>
		        		<span class="slider_alt alt-<?php echo $key; ?>"><?php echo $image['alt']; ?></span>
		        		<span class="slider_description des-<?php echo $key; ?>"><?php echo $image['description']; ?></span>
		        		<?php //var_dump($image); ?>
		        	</div>
		        </div>
	        	<!-- <a class="image-link" href="<?php echo $image['url']; ?>">
	            	<img class="img-responsive  fit-image_rent" src="<?php echo bfi_thumb( $image['url'], $params_news_img  ); ?>" alt="<?php echo $image['alt']; ?>" />
	            </a> -->

			<?php
			endforeach;
			?>
		 
		</div>


	</div>

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'loop-templates/content', 'page-rent' ); ?>

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :

							comments_template();

						endif;
						?>

					<?php endwhile; // end of the loop. ?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
