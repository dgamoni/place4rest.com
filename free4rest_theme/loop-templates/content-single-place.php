<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">

			<?php //understrap_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<div class="row">

		<div class="col-6 slider_wrap">

			<?php if( have_rows('free4rest_front_gallery') ): ?>
				
				<div class="bxslider">
					
					<?php while( have_rows('free4rest_front_gallery') ): the_row(); 
						$image = get_sub_field('free4rest_front_gallery_img');	?>
		                	
		                	<a class="image-link" href="<?php echo $image['url']; ?>">
		                    	<img class="img-responsive fit-image " src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
		                    </a>

					<?php endwhile; ?>

				</div>

			<?php else: 
				$thumbnail_url = get_the_post_thumbnail_url( $post, 'large' );
				echo '<a class="image-link" href="'.$thumbnail_url.'">'.get_the_post_thumbnail( $post->ID, 'large' ).'</a>'; 
			endif; ?>
		</div>

		<div class="col-6">
			<div class="place_meta">
				<div class="meta_cat_place">
					<?php //echo get_the_term_list( $post->ID, 'cat_place', 'Category: ', ',', '' ); ?>
				</div>
				<div class="rate_wrap">
					<?php echo f4rst_get_comment_rate( $post->ID ); ?>
					<?php echo f4rst_get_comments_number( $post->ID ); ?>
				</div>
				<div class="gps_wrap">
					<?php 
						$lat = get_post_meta($post->ID, 'locate-anything-lat')[0];
						$lon = get_post_meta($post->ID, 'locate-anything-lon')[0];
					?>
					<span><?php echo DECtoDMS($lat, $lon); ?></span>
					<div><?php echo $lat; ?>, <?php echo $lon; ?></div>
				</div>
				<div class="tags_wrap">
					<div class="cat_place tags_list">
						<?php
							//$cat_places = get_terms( array('taxonomy' => 'cat_place', 'hide_empty' => false) ); 
							$cat_places= get_the_terms( $post->ID, 'cat_place' );
							foreach ($cat_places as $key => $cat_place) {
								echo '<span class="tags_element_full '.$cat_place->slug.'" title="'.$cat_place->name.'"></span>';
							}
							//$cat_place_fors = get_terms( array('taxonomy' => 'cat_place_for', 'hide_empty' => false) ); 
							$cat_place_fors= get_the_terms( $post->ID, 'cat_place_for' );
							foreach ($cat_place_fors as $key => $cat_place_for) {
								echo '<span class="tags_element_full '.$cat_place_for->slug.'" title="'.$cat_place_for->name.'"></span>';
							}							
						?>						
					</div>
					<div class="cat_services tags_list">
						<?php
							//$cat_services = get_terms( array('taxonomy' => 'cat_services', 'hide_empty' => false) ); 
							$cat_services = get_the_terms( $post->ID, 'cat_services' );
							foreach ($cat_services as $key => $cat_service) {
								echo '<span class="tags_element '.$cat_service->slug.'" title="'.$cat_service->name.'"></span>';
							}
						?>
					</div>
					<div class="cat_activity tags_list">
						<?php 
							//$cat_activitys = get_terms( array('taxonomy' => 'cat_activity', 'hide_empty' => false) ); 
							$cat_activitys = get_the_terms( $post->ID, 'cat_activity' );
							foreach ($cat_activitys as $key => $cat_activity) {
								echo '<span class="tags_element '.$cat_activity->slug.'" title="'.$cat_activity->name.'"></span>';
							}
						?>
					</div>					
				</div>
			</div>
		</div>
	</div>
	
	<div class="entry-content">

		<?php the_content(); ?>

	</div><!-- .entry-content -->	


	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
