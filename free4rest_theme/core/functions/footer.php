<?php
/**
 * Custom hooks.
 *
 * @package understrap
 */

if ( ! function_exists( 'understrap_site_info_child' ) ) {
  /**
   * Add site info hook to WP hook library.
   */
  function understrap_site_info_child() {
    do_action( 'understrap_site_info_child' );
  }
}

if ( ! function_exists( 'understrap_add_site_info_child' ) ) {
  add_action( 'understrap_site_info_child', 'understrap_add_site_info_child' );

  /**
   * Add site info content.
   */
  function understrap_add_site_info_child() {
    $the_theme = wp_get_theme();
    
    $site_info = sprintf(
      //'<a href="%1$s">%2$s</a><span class="sep"> | </span>%3$s <span class="sep"> | </span>%4$s ',
      '<a href="%1$s">%2$s</a><span class="sep"> | </span>%3$s ',
      esc_url( __( 'http://wordpress.org/', 'understrap' ) ),
      sprintf(
        /* translators:*/
        esc_html__( 'Proudly powered by %s', 'understrap' ), 'WordPress'
      ),
      sprintf( // WPCS: XSS ok.
        /* translators:*/
        esc_html__( 'Theme: %1$s by %2$s.', 'understrap' ), 'place4rest', '<a href="' . esc_url( __( 'http://understrap.com', 'understrap' ) ) . '">understrap.com</a>'
      )//,
      // sprintf( // WPCS: XSS ok.
      //   /* translators:*/
      //   esc_html__( 'Made in %1$s ', 'understrap' ), '<a target="_blank" href="' . esc_url( __( 'http://bigcatcode.com', 'understrap' ) ) . '">bigcatcode.com</a>'
      // )
    );

    echo apply_filters( 'understrap_site_info_content', $site_info ); // WPCS: XSS ok.
  }
}
