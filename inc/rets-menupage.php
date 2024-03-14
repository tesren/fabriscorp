<?php

add_menu_page(
    'Actualizar Propiedades Flex MLS',
    'Actualizar Propiedades Flex MLS',
    'read',
    'rets_listings',
    'custom_admin_page',
    'dashicons-image-rotate',
    7
);

function load_custom_wp_admin_style($hook) {
	// Load only on ?page=mypluginname
	if( $hook != 'toplevel_page_rets_listings' ) {
		return;
	}
	wp_enqueue_style( 'bootstrap_admin_css', get_template_directory_uri().'/assets/css/bootstrap.min.css', array(), '5.3.2' , 'all'  );
	//wp_enqueue_style( 'custom_wp_admin_css', get_template_directory_uri().'/assets/css/admin-styles.css', array(), '1.0' , 'all'  );
    wp_enqueue_script( 'bootstrap_js_bundle', get_template_directory_uri().'/assets/js/bootstrap.bundle.min.js', '5.3.2', 'all' );
}

add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );



function custom_admin_page(){

    require_once( get_template_directory(). '/inc/rets-menupage-template.php' );

}