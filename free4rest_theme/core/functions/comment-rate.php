<?php

function f4rst_get_comment_rate( $post_id ) {

			$args = array(
				'post_id' =>  $post_id, // правильно post_id, а не post_ID
			);
			$comments = get_comments($args);
			$c_id = array();
			$rates = array();
			$count_rate = 0;
			$rate = array();

			foreach($comments as $comment){
				$c_id[] = $comment->comment_ID;
				$rates[] = get_field( 'free4rest_rate_comment', 'comment_'.$comment->comment_ID)[1];
				if ( get_field( 'free4rest_rate_comment', 'comment_'.$comment->comment_ID)[1] ) {
					$count_rate++;
				}
			}
			//return round( array_sum($rates)/$count_rate );
			//return $rates;

			return f4rst_render_full_rate( round( array_sum($rates)/$count_rate ) );

}

function f4rst_render_full_rate( $summ ) {

	$html = '
		<div class="field_type-star_rating" data-rate="'.floatval( $value ).'">
			%s
		</div>
	';

	return sprintf(
		$html, 
		f4rst_make_list( 
			5, 
			$summ,
			'<li><i class="%s star-%d"></i></li>', 
			array('fa fa-star', 'fa fa-star-o', 'fa fa-star-half-o') 
		)
	);
}

function f4rst_make_list($max_stars, $current_star, $li, $classes )	{
		$is_half = $current_star != round($current_star);
		
		$html = '<ul class="star-rating">';
		
		for( $index = 1; $index < $max_stars + 1; $index++ ):
			$class = $classes[1];
			if ($index <= $current_star) {
				$class = $classes[0];				
			} else if ($is_half && $index <= $current_star + 1) {
				$class = $classes[2];				
			}

			$html .= sprintf($li, $class, $index);
		endfor;
				
		$html .= "</ul>";
		
		return $html;
		
	}

function f4rst_get_comments_number( $post_id, $link = true ) {
	$num_comments = get_comments_number( $post_id ); // возвратит число

	if ( comments_open( $post_id ) ) {
		if ( $num_comments == 0 ) {
			$comments = __('No Reviews', 'free4rest');
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . __(' Reviews', 'free4rest');
		} else {
			$comments = __('1 Review', 'free4rest');
		}

		if( $link ){
			$write_comments = '<a class="comment_link" href="' . get_comments_link($post_id) .'" target="_blank">'. $comments.'</a>';
		} else {
			$write_comments = '<span class="comment_link" >'. $comments.'</span>';
		}
		
	} else {
		$write_comments =  __('Comments are off for this post.');
	}

	return $write_comments;
}