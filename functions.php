<?php
/**
 * Fabris Corp functions and definitions
*/

date_default_timezone_set('America/Mexico_City');

require_once("vendor/autoload.php");

if ( ! function_exists( 'fabris_theme_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @return void
	 */
	function fabris_theme_support() {

		// Add support 
		add_theme_support('title-tag');
		add_theme_support('custom-logo');
		add_theme_support('post-thumbnails');
		add_theme_support( 'custom-header' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );
	}

endif;

//ENABLE CUSTOM MENU

function custom_nav_menus()
{    
    $locations = array(
        'primary' => __( 'Menu principal' ),
    );
    
    register_nav_menus( $locations );
}

add_action('init', 'custom_nav_menus');



add_action( 'after_setup_theme', 'fabris_theme_support' );


/**
 * Fabris Corp Custom Post Types
*/

require get_template_directory().'/inc/listing-cpt.php';
require get_template_directory().'/inc/sales-team-cpt.php';
//require get_template_directory().'/inc/region-cpt.php';
require get_template_directory().'/inc/messages-cpt.php';
require get_template_directory().'/inc/reviews-cpt.php';


/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/classes/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );


/**
 * Fabris Corp Custom Functions
*/
function get_list_terms($postID, $taxonomy) {
    $terms_list = wp_get_post_terms($postID, $taxonomy);

    if (is_wp_error($terms_list)) {
        // Manejar el error de manera apropiada, por ejemplo, mostrar un mensaje o registrar el error
        echo 'Error al obtener los términos: ' . $terms_list->get_error_message();
        return;
    }

    $terms_list = array_reverse($terms_list);

    $j = 1;
    if (!empty($terms_list)) {
        foreach ($terms_list as $term) {
            echo $term->name;
            if ($j < count($terms_list)) {
                echo ', ';
            }
            $j++;
        }
    }
}


function get_property_type($postID, $taxonomy){
        
	$terms_list = array_reverse(wp_get_post_terms( $postID, $taxonomy ) );

	if ( ! empty( $terms_list ) && ! is_wp_error( $terms_list ) ) {
		foreach ( $terms_list as $term ) {
			echo $term->name;
		}
	}
}


//variables que conozco
/* 
    LIST_48 = Pies cuadrados
    LIST_35 = Nombre de la propiedad
    LIST_15 = Estatus
    LIST_22 = Precio de lista USD
    LIST_39 = Ciudad
    LIST_40 = Estado
    LIST_78 = Descripción
    LIST_96 = Amueblado
    LIST_88 = Vista Principal
    LIST_113 = Parking
    LIST_130 = Colonia
    LIST_46 = Latitud
    LIST_47 Longitud
    LIST_3 = MLS ID
    LIST_29 = Region
 */

function get_rets_listings(){
    $config = new \PHRETS\Configuration;
    $config->setLoginUrl('http://retsgw.flexmls.com/rets2_3/Login')
            ->setUsername('pvr.rets.fabriscorp')
            ->setPassword('aG(0KSslEi');

    $rets = new \PHRETS\Session($config);

    $connect = $rets->Login();

    $results = $rets->Search('Property', 'A', '*', ['Limit' => 2]);
    
    return $results->toArray();
}


function fabris_set_strings_transtaltion(){
        
	
	$strings = [
		'buy_sell_listings' => 'Compra y Venta de Inmuebles',
		'buy_sell_desc' => 'La representación de nuestros clientes al enlistar sus propiedades es una de nuestras mayores labores que disfrutamos hacer, con el fin de poder vender sus propiedades en el tiempo y forma que el cliente desea. De igual forma, nos encargamos en la búsqueda de propiedades con base en las necesidades que nuestros clientes deseen conseguir en el mercado.',
		'closing_coord' => 'Coordinación de cierres',
		'closing_desc' => 'Somos expertos en el manejo de los trámites legales y burocráticos ante las notarías públicas respectivas y otros organismos públicos, con el fin de poder lograr la transmisión de la propiedad en la compraventa de una propiedad en tiempo y forma.',
		'testimonials' => 'Testimoniales',
		'contact_us' => 'CONTÁCTANOS',
		'today' => 'HOY MISMO',
		'contact_desc' => 'Si estás interesado con comprar o rentar alguna de nuestras propiedades, te invitamos a hacer clic en el siguiente botón para que uno de nuestros asesores pueda brindarte atención especializada.',
		'send_message' => 'Mandar mensaje',
		'properties_nv_rn' => 'Propiedades en Nuevo Vallarta y Riviera Nayarit',
		'meta_desc' => 'Propiedades de lujo en venta que se encuentran diferentes partes de la República Mexicana, tales como Nuevo Vallarta y Riviera Nayarit.',
		'footer_desc' => 'Fabris Corp es una empresa inmobiliaria experta en Bienes Raíces en todo México.',
		'additional_links'=>'Enlaces adicionales',
		'privacy_policy' => 'Aviso de Privacidad',
		'consumer_rights' => 'Carta de Derechos del Consumidor',
		'non_disc_policy' => 'Política de No Discriminación',
		'profeco_contract' => 'Contrato de Adhesión PROFECO',
		'follow_us' => 'Seguir en',
		'send_us' => '¡Envíanos',
		'a_message' => 'un mensaje!',
		'bedrooms' => 'Recámaras',
		'bathrooms' => 'Baños',
		'total_const' => 'Conts. Total',
		'lot_area' => 'Lote',
		'description'=>'Descripción',
		'amenities' => 'Amenidades',
		'wpp_msg' => 'Hola, vengo del sitio web de Fabris Corp',
		'wpp_text' => 'Contactar por WhatsApp',
		'available' => 'Disponible',
		'pending' => 'Apartado',
		'sold' => 'Vendido'
	];

	$translations = [];

	foreach($strings as $string => $value ){
		$translations[] = [
			'name' => $string,
			'string' => $value,
			'group' => 'Translations',
			'multiline'=>false,
		];
	}


	foreach ($translations as $string ) {
		pll_register_string( $string['name'], $string['string'], $string['group'], $string['multiline'] );
	};

}

add_action('init', 'fabris_set_strings_transtaltion');