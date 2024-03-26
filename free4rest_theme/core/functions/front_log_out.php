<?php
function wp_logout_url_custom($redirect = '') {
	$args = array( 'action' => 'logout' );
	if ( !empty($redirect) ) {
		$args['redirect_to'] = urlencode( $redirect );
	}

	$logout_url = add_query_arg($args, site_url('', 'login'));
	$logout_url = wp_nonce_url( $logout_url, 'log-out' );
	//wp_logout();
	/**
	 * Filters the logout URL.
	 *
	 * @since 2.8.0
	 *
	 * @param string $logout_url The HTML-encoded logout URL.
	 * @param string $redirect   Path to redirect to on logout.
	 */
	return apply_filters( 'logout_url', $logout_url, $redirect );
} 

// Hook the appropriate WordPress action
//add_action('init', 'prevent_wp_login');

function prevent_wp_login() {
    // WP tracks the current page - global the variable to access it
    global $pagenow;
    // Check if a $_GET['action'] is set, and if so, load it into $action variable
    $action = (isset($_GET['action'])) ? $_GET['action'] : '';
    // Check if we're on the login page, and ensure the action is not 'logout'
    if( $pagenow == 'wp-login.php' && ( ! $action || ( $action && ! in_array($action, array('logout', 'lostpassword', 'rp', 'resetpass'))))) {
        // Load the home page url
        $page = get_bloginfo('url');
        // Redirect to the home page
        wp_redirect($page);
        // Stop execution to prevent the page loading for any reason
        exit();
    }
}