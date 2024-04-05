<?php
/**
 * Fabris Corp functions and definitions
*/

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
require get_template_directory().'/inc/properties-cpt.php';
require get_template_directory().'/inc/rets-menupage.php';


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
			return $term->name;
		}
	}

	return false;
}


//variables que conozco
/* 
    LIST_48 = Pies cuadrados
    LIST_35 = Nombre de la propiedad
    LIST_15 = Estatus
    LIST_22 = Precio de lista USD
	LIST_240 = List Price MXN$
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
	GF20101117190905087047000000 = Amenidades
	LIST_66 = Total de recámaras
	LIST_67 = Total de baños
	LIST_126 = Total M2 const
	LIST_159 = CONDO M2
	LIST_119 = LOT M2
	LIST_8 = Tipo de propiedad
	LIST_82 = direcciones

	A = Condos
	B = Houses
	E = LotsAndLand
	F = CommonInterest
	G = Business
	H = Fractional
	I = MultiFamily
 */

 function get_all_rets_listings($page = 1, $perPage = 15){
    $config = new \PHRETS\Configuration;
    $config->setLoginUrl('http://retsgw.flexmls.com/rets2_3/Login')
            ->setUsername('pvr.rets.fabriscorp')
            ->setPassword('aG(0KSslEi');

    $rets = new \PHRETS\Session($config);

    $connect = $rets->Login();

    $condos = $rets->Search('Property', 'A', '*', ['Select' => 'LIST_3,LIST_35,LIST_22,LIST_15,LIST_8,LIST_35,LIST_36,LIST_39,LIST_40,LIST_66,LIST_67,LIST_126,LIST_130']);
    $condos = $condos->toArray();

    $houses = $rets->Search('Property', 'B', '*', ['Select' => 'LIST_3,LIST_35,LIST_22,LIST_15,LIST_8,LIST_35,LIST_39,LIST_40,LIST_66,LIST_67,LIST_126,LIST_130']);
    $houses = $houses->toArray();

    $land = $rets->Search('Property', 'E', '*', ['Select' => 'LIST_3,LIST_35,LIST_22,LIST_15,LIST_8,LIST_35,LIST_39,LIST_40,LIST_119,LIST_130']);
    $land = $land->toArray();

    $business = $rets->Search('Property', 'G', '*', ['Select' => 'LIST_3,LIST_35,LIST_22,LIST_15,LIST_8,LIST_35,LIST_39,LIST_40,LIST_126,LIST_130']);
    $business = $business->toArray();

    $multi = $rets->Search('Property', 'I', '*', ['Select' => 'LIST_3,LIST_35,LIST_22,LIST_15,LIST_8,LIST_35,LIST_39,LIST_40,LIST_126,LIST_130']);
    $multi = $multi->toArray();


    $results = array_merge($condos, $houses, $land, $business, $multi);

    $total_results_count = count($results);

    // Calcular el número total de páginas
    $total_pages = ceil($total_results_count / $perPage);

    // Calcular el índice de inicio para la paginación
    $start_index = ($page - 1) * $perPage;

    // Obtener solo las propiedades de la página actual
    $results = array_slice($results, $start_index, $perPage);

    return [
        'listings' => $results,
        'total_pages' => $total_pages
    ];
}

function search_rets_listings($page = 1, $perPage = 15, $property_type = 'A', $bedrooms, $min_price = 1, $max_price=9000000){
	$config = new \PHRETS\Configuration;
    $config->setLoginUrl('http://retsgw.flexmls.com/rets2_3/Login')
            ->setUsername('pvr.rets.fabriscorp')
            ->setPassword('aG(0KSslEi');

    $rets = new \PHRETS\Session($config);

    $connect = $rets->Login();


	$results = $rets->Search('Property', $property_type, '(LIST_22='.$min_price.'+),(LIST_22='.$max_price.'-)', ['Limit'=>150] );
    
	
	$results = $results->toArray();

    $total_results_count = count($results);

    // Calcular el número total de páginas
    $total_pages = ceil($total_results_count / $perPage);

    // Calcular el índice de inicio para la paginación
    $start_index = ($page - 1) * $perPage;

    // Obtener solo las propiedades de la página actual
    $results = array_slice($results, $start_index, $perPage);

    return [
        'listings' => $results,
        'total_pages' => $total_pages
    ];

}

function update_listings($types, $limit){
    $config = new \PHRETS\Configuration;
    $config->setLoginUrl('http://retsgw.flexmls.com/rets2_3/Login')
            ->setUsername('pvr.rets.fabriscorp')
            ->setPassword('aG(0KSslEi');

    $rets = new \PHRETS\Session($config);

    $connect = $rets->Login();

	$results = [];

	foreach($types as $type){
		$listings = $rets->Search('Property', $type, '(LIST_87=2007-01-05T07:00:00+)', ['Limit' => $limit]);
		$listings = $listings->toArray();

		$results = array_merge($results, $listings);
	}


    return $results;
}


function get_portrait_url($id){
	$config = new \PHRETS\Configuration;
    $config->setLoginUrl('http://retsgw.flexmls.com/rets2_3/Login')
            ->setUsername('pvr.rets.fabriscorp')
            ->setPassword('aG(0KSslEi');

    $rets = new \PHRETS\Session($config);

    $connect = $rets->Login();

	$objects = $rets->GetObject('Property', 'Photo', $id, '*', 1);

	$object = $objects->first();
	$url = $object->getLocation();

	return $url;
}

function get_gallery_urls($id){
	$config = new \PHRETS\Configuration;
    $config->setLoginUrl('http://retsgw.flexmls.com/rets2_3/Login')
            ->setUsername('pvr.rets.fabriscorp')
            ->setPassword('aG(0KSslEi');

    $rets = new \PHRETS\Session($config);

    $connect = $rets->Login();

	//solicitamos las imagenes para móvil
	$images = $rets->GetObject('Property', '640x480', $id, '*', 1);

	$mobile_urls = [];

	foreach($images as $object){
		$img = $object->getLocation();

		$mobile_urls[] = $img;
	}

	return $mobile_urls;
}


//funcion para actualizar automaticamente listings de flex
// Programa la tarea cron para ejecutarse todos los días a las 4 de la mañana
add_action( 'init', 'update_listings_cron_job' );

function update_listings_cron_job() {
    // Programa la tarea para que se ejecute todos los días a las 4 de la mañana
    if ( ! wp_next_scheduled( '4am_cron_job' ) ) {
        wp_schedule_event( strtotime( '04:00:00' ), 'daily', '4am_cron_job' );
    }
}

// Agrega la acción para la tarea cron
add_action( '4am_cron_job', 'fabris_update_listings_auto' );

// Define la función que se ejecutará
function fabris_update_listings_auto() {
    $config = new \PHRETS\Configuration;
    $config->setLoginUrl('http://retsgw.flexmls.com/rets2_3/Login')
            ->setUsername('pvr.rets.fabriscorp')
            ->setPassword('aG(0KSslEi');

    $rets = new \PHRETS\Session($config);

    $connect = $rets->Login();

	$results = [];

	$types = ['A', 'B', 'E', 'F', 'G', 'H', 'I'];

	foreach($types as $type){
		$listings = $rets->Search('Property', $type, '(LIST_87=2007-01-05T07:00:00+)', ['Limit' => 9999]);
		$listings = $listings->toArray();

		$results = array_merge($results, $listings);
	}


	foreach($results as $listing){
            
		$author_id = get_current_user_id() ?: 1;

		if( isset($listing['LIST_35']) and !empty($listing['LIST_35']) ){

			// Verificar si el post ya existe por su título
			$post_id = post_exists($listing['LIST_35']);

			$listing_en = pll_get_post($post_id, 'en'); // Obtener la traducción en inglés
			$listing_es = pll_get_post($post_id, 'es'); // Obtener la traducción en español

			if ($listing_es != null and $listing_en != null and $post_id != 0) {

				// Si ambos posts existen, actualiza sus metadatos
				$listing_post_es = array(
					'ID'           => $listing_es,
					'post_content' => $listing['LIST_78'],
					'meta_input'   => array(
						'mls_id'        => $listing['LIST_1'],
						'price'         => $listing['LIST_240'],
						'price_usd'     => $listing['LIST_22'],
						'property_type' => $listing['LIST_8'],
						'avaliable'     => $listing['LIST_15'],
						'bedrooms'      => $listing['LIST_66'] ?? '0',
						'bathrooms'     => $listing['LIST_67'] ?? '0',
						'construction'  => $listing['LIST_159'] ?? $listing['LIST_126'] ?? '0',
						'lot_area'      => $listing['LIST_119'] ?? $listing['LIST_126'] ?? '0',
						'state'         => $listing['LIST_40'],
						'city'          => $listing['LIST_39'],
						'community'     => $listing['LIST_130'],
						'map'           => $listing['LIST_46'] . ',' . $listing['LIST_47'] . ',14',
						'amenities'     => $listing['GF20101117190905087047000000'] ?? '0',
						'directions'    => $listing['LIST_82'],
					)
				);

				$listing_post_en = array(
					'ID'           => $listing_en,
					'post_content' => $listing['LIST_78'],
					'meta_input'   => array(
						'mls_id'        => $listing['LIST_1'],
						'price'         => $listing['LIST_240'],
						'price_usd'     => $listing['LIST_22'],
						'property_type' => $listing['LIST_8'],
						'avaliable'     => $listing['LIST_15'],
						'bedrooms'      => $listing['LIST_66'] ?? '0',
						'bathrooms'     => $listing['LIST_67'] ?? '0',
						'construction'  => $listing['LIST_159'] ?? $listing['LIST_126'] ?? '0',
						'lot_area'      => $listing['LIST_119'] ?? $listing['LIST_126'] ?? '0',
						'state'         => $listing['LIST_40'],
						'city'          => $listing['LIST_39'],
						'community'     => $listing['LIST_130'],
						'map'           => $listing['LIST_46'] . ',' . $listing['LIST_47'] . ',14',
						'amenities'     => $listing['GF20101117190905087047000000'] ?? '0',
						'directions'    => $listing['LIST_82'],
					)
				);

				wp_update_post($listing_post_es);
				wp_update_post($listing_post_en);
			} 
			elseif( $post_id == 0 ) {
				// Si el post no existe, créalo
				$listing_post = array(
					'post_type'    => 'listings',
					'post_title'   => $listing['LIST_35'],
					'post_status'  => 'publish',
					'post_content' => $listing['LIST_78'],
					'post_author'  => $author_id,
					'meta_input'   => array(
						'mls_id'        => $listing['LIST_1'],
						'price'         => $listing['LIST_240'],
						'price_usd'     => $listing['LIST_22'],
						'property_type' => $listing['LIST_8'],
						'avaliable'     => $listing['LIST_15'],
						'bedrooms'      => $listing['LIST_66'] ?? '0',
						'bathrooms'     => $listing['LIST_67'] ?? '0',
						'construction'  => $listing['LIST_159'] ?? $listing['LIST_126'] ?? '0',
						'lot_area'      => $listing['LIST_119'] ?? $listing['LIST_126'] ?? '0',
						'state'         => $listing['LIST_40'],
						'city'          => $listing['LIST_39'],
						'community'     => $listing['LIST_130'],
						'map'           => $listing['LIST_46'] . ',' . $listing['LIST_47'] . ',14',
						'amenities'     => $listing['GF20101117190905087047000000'] ?? '0',
						'directions'    => $listing['LIST_82'],
					)
				);

				//post en español
				$post_es = wp_insert_post($listing_post);
                pll_set_post_language($post_es, 'es');

				//post en inglés
				$post_en = wp_insert_post($listing_post);
                pll_set_post_language($post_en, 'en');

				// Guardar la relación de traducción entre los posts
				pll_save_post_translations([
					'es' => $post_es,
					'en' => $post_en,
				]);

			}

		}

	}

	return true;
    
}

// Agrega la columna personalizada
function custom_listing_columns( $columns ) {
    // Agrega una nueva columna después de la columna de título
	unset( $columns['date'] );

    $columns['property_type'] = 'Tipo de propiedad';
	$columns['date'] = 'Fecha';

    return $columns;
}
//add_filter( 'manage_listings_posts_columns', 'custom_listing_columns' );

// Muestra el contenido de la columna personalizada
function custom_listings_column_content( $column, $post_id ) {
    
	$property_type = rwmb_meta('property_type', [], $post_id);

	switch ( $property_type ) {

        case 'A' :
            echo 'Condominios';
            break;

        case 'B' :
            echo 'Casas y Villas'; 
            break;

		case 'E' :
			echo 'Lotes'; 
			break;

		case 'F' :
			echo 'Interés Común'; 
			break;

		case 'G' :
			echo 'Negocios'; 
			break;

		case 'H' :
			echo 'Fraccional'; 
			break;

		case 'I' :
			echo 'Multi Familiar'; 
			break;
    }
    
}
//add_action( 'manage_listings_posts_custom_column', 'custom_listings_column_content', 1, 2 );


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
		'sold' => 'Vendido',
		'zone' => 'Zona',
		'any_zone' => 'Cualquier Zona',
		'property_type' => 'Tipo de propiedad',
		'condos' => 'Condominios',
		'houses' => 'Casas y Villas',
		'lotes' => 'Lotes y Terrenos',
		'business' => 'Negocios',
		'multi_family' => 'Multi Familiar',
		'no_minimum' => 'Sin mínimo',
		'no_max' => 'Sin Máximo',
		'search' => 'Buscar',
		'search_results' => 'Resultados de la Busqueda',
		'no_results' => 'Lo sentimos, no hay resultados',
		'but_more_listings' => 'Pero estas propiedades podrían interesarte',
		'exclusive_properties' => 'Propiedades Exclusivas',
		'View Photos' => 'Ver Galería',
		'location' => 'Ubicación',
		'all_listings'=>'Todas las Propiedades',
		'luxury_listings' => 'Propiedades de lujo',
		'property_search' => 'Búsqueda de propiedades',
		'properties_on_sale' => 'Propiedades en venta',
		'all_types' => 'Todo',
		'fractional' => 'Fraccional',
		'common_interest' => 'Interés Común',
		'land' => 'Lotes',
		'fill_contact_form' => 'Llene el formulario y nos comunicaremos con usted lo más pronto posible',
		'mls_disclaimer' => 'Toda la información se considera confiable, pero no garantizada. Los listados en este sitio se muestran por cortesía del programa IDX de AMPI Vallarta Nayarit MLS y pueden no ser listados del propietario del sitio. Datos actualizados por última vez: ',
		'price_disclaimer'=> 'Los precios publicados en dólares deberán ser pagados en pesos mexicanos, de acuerdo con el tipo de cambio establecido en el Diario Oficial de la Federación en la fecha en que se realicen los pagos por la compraventa.',
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