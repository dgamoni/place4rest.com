<?php
function my_page_template_redirect(){
	if ( is_tax('cat_place') || is_tax('cat_place_for') || is_tax('cat_activity') || is_tax('cat_services') ) {
		wp_redirect( home_url() );
		exit();
	} else if ( is_singular( 'locateanythingmap' ) ) {
		wp_redirect( home_url() );
		exit();		
	}
}
add_action( 'template_redirect', 'my_page_template_redirect' );