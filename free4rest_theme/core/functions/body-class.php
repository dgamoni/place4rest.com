<?php

//add_filter('body_class','add_custom_body_class', 99 );
function add_custom_body_class( $classes ) {

    if( is_user_logged_in() ) {
       $classes[] = 'logged_in';
    }
    return $classes;
}