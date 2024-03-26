<?php

Locate_Anything_Addon_Helper::define_custom_tags( array( 'rate' =>'rate') ,'all', getDataCallbackFn_rate, 'rate');
function getDataCallbackFn_rate( $field, $id){
     return f4rst_get_comment_rate( $id ).f4rst_get_comments_number( $id, true );     
}

Locate_Anything_Addon_Helper::define_custom_tags( array( 'img_count' =>'img_count') ,'all', getDataCallbackFn_img_count, 'img_count');
function getDataCallbackFn_img_count( $field, $id){
			// $images = get_field('free4res_place_gallery', $id );
			// $img_count = count($images);
			$rows = get_field('free4rest_front_gallery', $id);
			$count = count($rows);
     return strval($count);     
}

Locate_Anything_Addon_Helper::define_custom_tags( array( 'place_tags' =>'place_tags') ,'all', getDataCallbackFn_place_tags, 'place_tags');
function getDataCallbackFn_place_tags( $field, $id){
	$html = '';
	ob_start();
			?>
				<div class="tags_wrap tooltip_tags">
					<div class="cat_services tags_list">
						<?php 
							$cat_services = get_the_terms( $id, 'cat_services' );
							foreach ($cat_services as $key => $cat_service) {
								echo '<span class="tags_element '.$cat_service->slug.'" title="'.$cat_service->name.'"></span>';
							}
						?>
					</div>
					<div class="cat_activity tags_list">
						<?php 
							$cat_activitys = get_the_terms( $id, 'cat_activity' );
							foreach ($cat_activitys as $key => $cat_activity) {
								echo '<span class="tags_element '.$cat_activity->slug.'" title="'.$cat_activity->name.'"></span>';
							}
						?>
					</div>					
				</div>
			<?php
		
		$html .= ob_get_contents();
		ob_end_clean();

    return strval($html);   
}

Locate_Anything_Addon_Helper::define_custom_tags( array( 'place_tags_main' =>'place_tags_main') ,'all', getDataCallbackFn_place_tags_main, 'place_tags_main');
function getDataCallbackFn_place_tags_main( $field, $id){
	$html = '';
	ob_start();
			?>
				<div class="cat_place tags_list">
					<?php
						//$cat_places = get_terms( array('taxonomy' => 'cat_place', 'hide_empty' => false) ); 
						$cat_places= get_the_terms( $id, 'cat_place' );
						foreach ($cat_places as $key => $cat_place) {
							echo '<span class="tags_element_full '.$cat_place->slug.'" title="'.$cat_place->name.'"></span>';
						}
						//$cat_place_fors = get_terms( array('taxonomy' => 'cat_place_for', 'hide_empty' => false) ); 
						$cat_place_fors= get_the_terms( $id, 'cat_place_for' );
						foreach ($cat_place_fors as $key => $cat_place_for) {
							echo '<span class="tags_element_full '.$cat_place_for->slug.'" title="'.$cat_place_for->name.'"></span>';
						}							
					?>						
				</div>
			<?php
		
		$html .= ob_get_contents();
		ob_end_clean();

    return strval($html);   
}

Locate_Anything_Addon_Helper::define_custom_tags( array( 'place_information' =>'place_information') ,'all', getDataCallbackFn_place_information, 'place_information');
function getDataCallbackFn_place_information( $field, $id){
	$html = '';
	ob_start(); ?>

		<?php if( have_rows('free4rest_front_information', $id) ): ?>

			<div class="free4rest_front_information">

				<?php while( have_rows('free4rest_front_information', $id) ): the_row(); ?>

					<?php 
					$open = get_sub_field_object('free4rest_front_information_open', $id);
						if ( $open['value'] ) {
							echo '<span class="info_elemet_wrap">';
								echo '<span class="info_element info_element_label">'.$open['label'].' :</span>';
								echo '<span class="info_element">'.$open['value'].'</span>';
							echo '</span>';
						} ?>

					<?php 
					$paids = get_sub_field_object('free4rest_front_information_paids', $id);
						if ( $paids['value'] ) {
							echo '<span class="info_elemet_wrap">';
								echo '<span class="info_element info_element_label">'.$paids['label'].' :</span>';
								echo '<span class="info_element">'.$paids['value'].'</span>';
							echo '</span>';
						} ?>

					<?php 
					$serv = get_sub_field_object('free4rest_front_information_services', $id);
						if ( $serv['value'] ) {
							echo '<span class="info_elemet_wrap">';
								echo '<span class="info_element info_element_label">'.$serv['label'].' :</span>';
								echo '<span class="info_element">'.$serv['value'].'</span>';
							echo '</span>';
						} ?>
				<?php endwhile; ?>
			
			</div>

		<?php endif; ?>
	<?php	
	$html .= ob_get_contents();
	ob_end_clean();

    return strval($html);   
}