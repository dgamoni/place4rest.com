<?php
function custom_child_scripts() {

	wp_enqueue_style(
		'jquery-bxslider', 
		CORE_URL . '/css/jquery.bxslider.css'
	);

	wp_enqueue_style(
		'magnific-popup', 
		CORE_URL . '/css/magnific-popup.css'
	);

	// wp_enqueue_style(
	// 	'flexslider', 
	// 	CORE_URL . '/css/flexslider.css'
	// );

	wp_enqueue_style(
		'custom-style', 
		CORE_URL . '/css/custom-style.css'
	);

	wp_enqueue_script(
	    'jquery-bxslider',
	    CORE_URL . '/js/jquery.bxslider.js'
	);

	wp_enqueue_script(
	    'jquery-magnific-popup-min',
	    CORE_URL . '/js/jquery.magnific-popup.min.js'
	);

	// wp_enqueue_script(
	//     'jquery-flexslider-min',
	//     CORE_URL . '/js/jquery.flexslider-min.js'
	// );

	wp_enqueue_script(
	    'product_script',
	    CORE_URL . '/js/custom.js',
        array('jquery'), // array('jquery')
        '1', // no ver
        true  // footer
	);

	wp_localize_script( 'product_script', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	
}
add_action( 'wp_enqueue_scripts', 'custom_child_scripts' ); 

function custom_child_scripts_admin() {

	wp_enqueue_script(
	    'custom_admin_script',
	    CORE_URL . '/js/custom_admin.js',
        array('jquery'), // array('jquery')
        '1', // no ver
        true  // footer
	);
}
add_action( 'admin_enqueue_scripts', 'custom_child_scripts_admin' ); 