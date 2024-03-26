<?php
add_action( 'widgets_init', 'understrap_widgets_init_child' );
function understrap_widgets_init_child() {
		register_sidebar( array(
			'name'          => __( 'Footer Full EN', 'understrap' ),
			'id'            => 'footerfull_en',
			'description'   => 'Full sized footer widget with dynamic grid',
		    'before_widget'  => '<div id="%1$s" class="footer-widget %2$s '. understrap_slbd_count_widgets( 'footerfull_en' ) .'">', 
		    'after_widget'   => '</div><!-- .footer-widget -->', 
		    'before_title'   => '<h3 class="widget-title">', 
		    'after_title'    => '</h3>', 
		) );	
}