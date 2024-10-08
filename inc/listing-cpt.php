<?php
add_action( 'init', 'listing_register_post_type' );

function listing_register_post_type(){

    $labels = array(
        'menu_name'          =>  'Propiedades' ,
        'name_admin_bar'     =>  'Propiedades' ,
        'add_new'            =>  'Agregar Propiedad' ,
        'add_new_item'       =>  'Agregar Propiedad' ,
        'new_item'           =>  'Nueva Propiedad' ,
        'edit_item'          =>  'Editar Propiedad' ,
        'view_item'          =>  'Ver Propiedad' ,
        'update_item'        =>  'Actualizar Propiedad' ,
        'all_items'          =>  'Todas las Propiedades' ,
        'search_items'       =>  'Buscar Propiedades' ,
        'parent_item_colon'  =>  'Padre Propiedad' ,
        'not_found'          =>  'No se encontraron Propiedades' ,
        'not_found_in_trash' =>  'No hay Propiedades en la papelera' ,
        'name'               =>  'Propiedad' ,
        'singular_name'      =>  'Propiedad' ,

    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' =>  true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array(
            'title',
            //'editor',
            'excerpt',
            //'thumbnail',
            'revisions',
        ),
        //'taxonomies' => array('category', 'post_tag'),
        'menu_icon' => 'dashicons-admin-home',
        'menu_positions' => 7,
        'exclude_from_search' => false

    );

    register_post_type('propiedad-en-venta', $args);

}

add_action('init', 'listing_register_post_type');


function heyhaus_listings_custom_taxonomies(){

    //add new taxonomi heirarchical
    $labels = array(
        'name' => 'Tipo de Propiedad', //Puede ser casas, depas, terrenos
        'singular_name' => 'Tipo de Propiedad',
        'search_items' => 'Buscar Tipos',
        'all_items' => 'Todos los tipos',
        'parent_item' => 'Tipo padre', 
        'parent_item_colon' => 'Tipo padre:',
        'edit_item' => 'Editar Tipo',
        'update_item' => 'Editar tipo',
        'add_new_item' => 'Agregar nuevo tipo', 
        'new_item_name' => 'Nuevo Tipo de propiedad',
        'manu_name' => 'Tipo de Propiedad'
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_in_menu' => true,
        'show_ui' => true,
        'show_admin_column' => true, //muestra u oculta la columna en vista admon para filtrar
        'query_var' => true,
        'rewrite' => array('slug' => 'tipo-propiedad') //Este parametro saldra en la URL
    );

    register_taxonomy('property_type', array('propiedad-en-venta', 'desarrollos'), $args );

    //add new taxonomi NOT heirarchical

     register_taxonomy('regiones', array('propiedad-en-venta'), array(
        'label' => 'Áreas',
        'show_ui' => true,
        'show_in_menu' => true,
        'show_admin_column' => true, //muestra u oculta la columna en vista admon para filtrar
        'query_var' => true,
        'rewrite' => array('slug' => 'area'), //Este parametro saldra en la URL
        'hierarchical' => true,
    ));



}

add_action('init', 'heyhaus_listings_custom_taxonomies');


add_filter( 'rwmb_meta_boxes', 'listing_register_meta_boxes' );

function listing_register_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = [
        'title'      => 'Detalles',
        'post_types' => 'propiedad-en-venta',

        'fields' => [
            [
                'name'  => 'Descripción general',
                'placeholder'  => 'Descripción general',
                'id'    => 'description',
                'type'  => 'textarea',
                'required' => true,
                'rows' =>  7,
            ],
            [
                'name'  => 'Precio en pesos (MXN)',
                'desc'  => 'Precio de la propiedad en pesos mexicanos',
                'id'    => 'price',
                'type'  => 'number',
                'required'=> false,
                'size' => 30,
            ],
            [
                'name'  => 'Precio en dólares (USD)',
                'desc'  => 'Precio de la propiedad en dólares',
                'id'    => 'price_usd',
                'type'  => 'number',
                'required'=> false,
                'size' => 30,
            ],
            [
                'name'  => 'Prioridad',
                'desc'  => 'Lugar en el que le gustaría que esté la propiedad, las propiedades con el numero más bajo se muestran primero',
                'id'    => 'priority',
                'type'  => 'number',
                'required'=> true,
                'min'   => 1,
                'std'   => '100',
                'size' => 20,
            ],
            [
                    'name'       => 'Tipo propiedad',
                    'id'         => 'taxonomy',
                    'type'       => 'taxonomy',

                    // Taxonomy slug.
                    'taxonomy'   => 'property_type',

                    // How to show taxonomy.
                    'field_type' => 'radio_list',
            ],
            [
                'name'            => 'Disponibilidad',
                'id'              => 'avaliable',
                'type'            => 'select',
                'required'        => true,
                // Array of 'value' => 'Label' pairs
                'options'         => array(
                    'Disponible'  => 'Disponible',
                    'Apartado'    => 'Apartado',
                    'Vendido'     => 'Vendido',
                ),
                // Allow to select multiple value?
                'multiple'        => false,
                // Placeholder text
                'placeholder'     => 'Elige una opción',
                // Display "Select All / None" button?
                'select_all_none' => false,
                'size' => 30,
            ],
            [
                'name'       => 'Ubicación',
                'id'         => 'location',
                'type'       => 'taxonomy',
                // Taxonomy slug.
                'taxonomy'   => 'regiones',

                // How to show taxonomy.
                'field_type' => 'select_tree',
            ],
             [
                'name'  => 'Recámaras',
                'desc'  => 'Solo numeros',
                'id'    => 'bedrooms',
                'type'  => 'number',
                'size' => 30,
            ],
            [
                'name'  => 'Baños',
                'desc'  => 'Solo números',
                'id'    => 'bathrooms',
                'type'  => 'number',
                'size' => 30,
                'step' => 0.5,
            ],
            [
                'name'  => 'Construcción',
                'desc'  => 'Solo números (m2)',
                'id'    => 'construction',
                'type'  => 'number',
                'step'  => 0.01,
                'size' => 30,
            ],
            [
                'name'  => 'Lote',
                'desc'  => 'Solo números (m2)',
                'id'    => 'lot_area',
                'type'  => 'number',
                'step'  => 0.01,
                'size' => 30,
            ],
            /* [
                'name' => 'Mostrar en Página de inicio',
                'id'   => 'featured_listing',
                'type' => 'checkbox',
                'std'  => 0,
            ], */
            [
                'name'            => 'Amenidades',
                'id'              => 'amenities_new',
                'type'            => 'checkbox_list',
                'inline'          => true,
                'select_all_none' => true,
                'options' => [
                    'Seguridad 24 Horas' => 'Seguridad 24 Horas',
                    'Bar' => 'Bar',
                    'Asador' => 'Asador',
                    'Estacionamiento' => 'Estacionamiento',
                    'Casa Club' => 'Casa Club',
                    'Casa del barco' => 'Casa del barco',
                    'Campo de amarre para botes' => 'Campo de amarre para botes',
                    'Cubierta' => 'Cubierta',
                    'Valla/Muro' => 'Valla/Muro',
                    'Fogatas' => 'Fogatas',
                    'Fuente' => 'Fuente',
                    'Jardín' => 'Jardín',
                    'Cine en casa' => 'Cine en casa',
                    'Bañera de hidromasaje/Jacuzzi' => 'Bañera de hidromasaje/Jacuzzi',
                    'Rincón de cocina' => 'Rincón de cocina',
                    'Cuartos de servicio' => 'Cuartos de servicio',
                    'Cocina al aire libre' => 'Cocina al aire libre',
                    'Ducha al aire libre' => 'Ducha al aire libre',
                    'Palapa' => 'Palapa',
                    'Patio' => 'Patio',
                    'Pérgola' => 'Pérgola',
                    'Área para mascotas' => 'Área para mascotas',
                    'Alberca' => 'Alberca',
                    'Calentador de Alberca' => 'Calentador de Alberca',
                    'Terraza en la azotea' => 'Terraza en la azotea',
                    'Sauna' => 'Sauna',
                    'Segunda cocina' => 'Segunda cocina',
                    'Sala de estar' => 'Sala de estar',
                    'Spa' => 'Spa',
                    'Zona de almacenamiento' => 'Zona de almacenamiento',
                    'Edificio de almacenamiento' => 'Edificio de almacenamiento',
                    'Terraza' => 'Terraza',
                    'Cascadas de agua' => 'Cascadas de agua',
                    'Fuente de agua' => 'Fuente de agua',
                    'Bodega' => 'Bodega',
                    'Gimnasio' => 'Gimnasio',
                    'Área de juegos para niños' => 'Área de juegos para niños',
                    'Sala de juegos' => 'Sala de juegos',
                    'Cancha de tenis' => 'Cancha de tenis',
                    'Cancha de baloncesto' => 'Cancha de baloncesto',
                    'Sala de conferencias' => 'Sala de conferencias',
                    'Salón de fiestas' => 'Salón de fiestas',
                    'Zona de barbacoa' => 'Zona de barbacoa',
                    'Parque' => 'Parque',
                    'Cancha de voleibol' => 'Cancha de voleibol',
                    'Área de picnic' => 'Área de picnic',
                    'Club de playa' => 'Club de playa',
                    'Acceso a la playa' => 'Acceso a la playa',
                    'Elevador' => 'Elevador',
                    'Sala de cine' => 'Sala de cine',
                    'Oficinas' => 'Oficinas',
                    'Salón de usos múltiples' => 'Salón de usos múltiples',
                    'Coworking' => 'Coworking',
                    'Parque para perros' => 'Parque para perros',
                    'Estacionamiento subterráneo' => 'Estacionamiento subterráneo',
                    'Pista de patinaje' => 'Pista de patinaje',
                    'Salón de belleza' => 'Salón de belleza',
                    'Tienda de conveniencia' => 'Tienda de conveniencia',
                    'Cafetería' => 'Cafetería',
                    'Restaurante' => 'Restaurante',
                    'Bar en la piscina' => 'Bar en la piscina'
                ],
            ],
            
            // More fields.
        ],
    ];


    // Add more field groups if you want
    $meta_boxes[] = [
        
        'title' => 'Galería',
        'post_types' => 'propiedad-en-venta',

        'fields' => [
            [
                'id'               => 'listing_gallery',
                'name'             => 'Image upload',
                'type'             => 'image_advanced',

                // Delete file from Media Library when remove it from post meta?
                // Note: it might affect other posts if you use same file for multiple posts
                'force_delete'     => false,

                // Maximum file uploads.
                'max_file_uploads' => 40,

                // Do not show how many files uploaded/remaining.
                'max_status'       => 'false',

                // Image size that displays in the edit page.
                'image_size'       => 'thumbnail',
            ],
        ]
    ];

     $meta_boxes[] = [
        
        'title' => 'Mapa de Google',
        'post_types' => 'propiedad-en-venta',

        'fields' => [
            // Map field.
            [
                'id'            => 'map',
                'name'          => 'Ubicación',
                'type'          => 'map',

                // Default location: 'latitude,longitude[,zoom]' (zoom is optional)
                'std'           => '20.6985662,-105.3090504,14',

                // Google API key
                'api_key'       => 'AIzaSyDlDmMESUjBK1gwNJm5x4hyoS90qacpJmY',
            ]
        ],
    ];

    return $meta_boxes;
}