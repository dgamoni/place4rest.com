<?php

/**
 * Back-end creation of new candidate post
 * @uses Advanced Custom Fields Pro
 */
//add_filter('acf/pre_save_post' , 'tsm_do_pre_save_post' );
function tsm_do_pre_save_post( $post_id ) {
	$map = get_post_meta($post_id, 'free4rest_front_map', true);
	var_dump($map);
	var_dump( $_POST); die();
	// // Bail if not logged in or not able to post
	// if ( ! ( is_user_logged_in() || current_user_can('publish_posts') ) ) {
	// 	return;
	// }

	// // check if this is to be a new post
	// if( $post_id != 'new_post' ) {
	// 	return $post_id;
	// }

	// // Create a new post
	// $post = array(
	// 	'post_type'     => 'place', // Your post type ( post, page, custom post type )
	// 	'post_status'   => 'draft', // (publish, draft, private, etc.)
	// 	//'post_title'    => wp_strip_all_tags($_POST['acf']['field_54dfc93e35ec4']), // Post Title ACF field key
	// 	//'post_content'  => $_POST['acf']['field_54dfc94e35ec5'], // Post Content ACF field key
	// );

	// // insert the post
	// $post_id = wp_insert_post( $post );

	// // Save the fields to the post
	// do_action( 'acf/save_post' , $post_id );

	return $post_id;

}

//save place
add_action( 'acf/save_post', 'tsm_save_image_field_to_featured_image', 10 );
function tsm_save_image_field_to_featured_image( $post_id ) {

	// Bail if not logged in or not able to post
	if ( ! ( is_user_logged_in() || current_user_can('publish_posts') ) ) {
		return;
	}

	// Bail early if no ACF data
	if( empty($_POST['acf']) ) {
		return;
	}

	// ACF image field key
	//$image = $_POST['acf']['field_54dfcd4278d63'];

	// Bail if image field is empty
	// if ( empty($image) ) {
	// 	return;
	// }

	// Add the value which is the image ID to the _thumbnail_id meta data for the current post
	//add_post_meta( $post_id, '_thumbnail_id', $image );

	// email data
	$to = 'dgamoni@gmail.com';
	$headers = 'From: free4rest.com <admin@free4rest.com>' . "\r\n";
	$subject = 'added new place '.$post->post_title;
	$body = $post->post_content;
	
	// send email
	wp_mail($to, $subject, $body, $headers );

}

// Change Title Lable
function change_title_label( $field ) {
    $field['label'] = __( 'Название места', 'free4rest' );
    return $field;
}
add_filter('acf/load_field/name=_post_title', 'change_title_label');

// Change Post Content to Required
function change_post_content_required( $field ) {
    $field['required'] = false;
    return $field;
}
//add_filter('acf/load_field/name=_post_title', 'change_post_content_required');

// Set Featured Image from ACF Field
function acf_set_featured_image( $value, $post_id, $field ) {
    if($value != ''){
        update_post_meta($post_id, '_thumbnail_id', $value);
    } else {
        if ( has_post_thumbnail() ) {
            delete_post_thumbnail( $post_id);
        } 
    }
    return $value;
}
add_filter('acf/update_value/name=free4rest_front_featured_img', 'acf_set_featured_image', 10, 3);

// Set excerpt
function acf_set_free4rest_front_excerpt( $value, $post_id, $field ) {
    if($value != ''){

    	// Создаем массив данных
		$my_post = array();
		$my_post['ID'] = $post_id;
		$my_post['post_excerpt'] = $value;
		$my_post->edit_date = true;

		// Обновляем данные в БД
		wp_update_post( wp_slash($my_post) );
        
    } else {

    }
    return $value;
}
//add_filter('acf/update_value/name=free4rest_front_excerpt', 'acf_set_free4rest_front_excerpt', 10, 3);

// Set content
function acf_set_free4rest_front_content( $value, $post_id, $field ) {
    if($value != ''){

    	// Создаем массив данных
		$my_post = array();
		$my_post['ID'] = $post_id;
		$my_post['post_content'] = $value;
		$my_post->edit_date = true;

		// Обновляем данные в БД
		wp_update_post( wp_slash($my_post) );
        
    } else {

    }
    return $value;
}
add_filter('acf/update_value/name=free4rest_front_content', 'acf_set_free4rest_front_content', 10, 3);


// Set gallery
function acf_set_free4rest_front_gallery( $value, $post_id, $field ) {
    if($value != ''){
        update_post_meta($post_id, 'free4rest_front_gallery', $value);
    } else {
    }
    return $value;
}
//add_filter('acf/update_value/name=free4rest_front_gallery', 'acf_set_free4rest_front_gallery', 10, 3);


function acf_set_free4rest_front_map( $value, $post_id, $field ) {
    if($value != ''){
    	$location = $value;
    	 //update_post_meta( $post_id, 'locate-anything-lat', $location['lat'] )[0];
    	 //update_post_meta( $post_id, 'locate-anything-lon', $location['lng'] )[0];
    	 update_post_meta( $post_id, 'free4rest_front_map', $value );
    } else {
    }
    return $value;
}
//add_filter('acf/update_value/name=free4rest_front_map', 'acf_set_free4rest_front_map', 10, 3);


// Set cat
function acf_set_free4rest_front_category( $value, $post_id, $field ) {
    if($value != ''){
        wp_set_post_terms( $post_id, $value, 'cat_place' );
    } else {
    }
    return $value;
}
add_filter('acf/update_value/name=free4rest_front_category', 'acf_set_free4rest_front_category', 10, 3);

// Set sevices
function acf_set_free4rest_front_services( $value, $post_id, $field ) {
    if($value != ''){
        wp_set_post_terms( $post_id, $value, 'cat_services' );
    } else {
    }
    return $value;
}
add_filter('acf/update_value/name=free4rest_front_services', 'acf_set_free4rest_front_services', 10, 3);

// Set cat
function acf_set_free4rest_front_activity( $value, $post_id, $field ) {
    if($value != ''){
        wp_set_post_terms( $post_id, $value, 'cat_activity' );
    } else {
    }
    return $value;
}
add_filter('acf/update_value/name=free4rest_front_activity', 'acf_set_free4rest_front_activity', 10, 3);


// Set lat
function acf_set_free4rest_front_lat( $value, $post_id, $field ) {
    if($value != ''){
        update_post_meta($post_id, 'locate-anything-lat', $value)[0];
    } else {
    }
    return $value;
}
add_filter('acf/update_value/name=free4rest_front_lat', 'acf_set_free4rest_front_lat', 10, 3);

// Set lon
function acf_set_free4rest_front_lon( $value, $post_id, $field ) {
    if($value != ''){
        update_post_meta($post_id, 'locate-anything-lon', $value)[0];
    } else {
    }
    return $value;
}
add_filter('acf/update_value/name=free4rest_front_lon', 'acf_set_free4rest_front_lon', 10, 3);


// Set cat
function acf_set_free4rest_front_cat_place_for( $value, $post_id, $field ) {
    if($value != ''){
        wp_set_post_terms( $post_id, $value, 'cat_place_for' );
    } else {
    }
    return $value;
}
add_filter('acf/update_value/name=free4rest_front_cat_place_for', 'acf_set_free4rest_front_cat_place_for', 10, 3);