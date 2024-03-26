<?php

Locate_Anything_Addon_Helper::define_custom_tags( array( 'rate' =>'rate') ,'all', getDataCallbackFn_rate, 'rate');
function getDataCallbackFn_rate( $field, $id){
     return f4rst_get_comment_rate( $id ).f4rst_get_comments_number( $id, true );     
}

Locate_Anything_Addon_Helper::define_custom_tags( array( 'img_count' =>'img_count') ,'all', getDataCallbackFn_img_count, 'img_count');
function getDataCallbackFn_img_count( $field, $id){
			$images = get_field('free4res_place_gallery', $id );
			$img_count = count($images);
     return strval($img_count);     
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