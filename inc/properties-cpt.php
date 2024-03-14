<?php
add_action( 'init', 'properties_register_post_type' );

function properties_register_post_type(){

    $labels = array(
        'menu_name'          =>  'Propiedades MLS' ,
        'name_admin_bar'     =>  'Propiedades MLS' ,
        'add_new'            =>  'Agregar Propiedad' ,
        'add_new_item'       =>  'Agregar Propiedad' ,
        'new_item'           =>  'Nueva Propiedad' ,
        'edit_item'          =>  'Editar Propiedad' ,
        'view_item'          =>  'Ver Propiedad' ,
        'update_item'        =>  'Actualizar Propiedad' ,
        'all_items'          =>  'Todas las Propiedades MLS' ,
        'search_items'       =>  'Buscar Propiedades MLS' ,
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
            'editor',
            //'excerpt',
            //'thumbnail',
            'revisions',
        ),
        //'taxonomies' => array('category', 'post_tag'),
        'menu_icon' => 'dashicons-admin-multisite',
        'menu_positions' => 7,
        'exclude_from_search' => false

    );

    register_post_type('listings', $args);

}

add_action('init', 'properties_register_post_type');


add_filter( 'rwmb_meta_boxes', 'properties_register_meta_boxes' );

function properties_register_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = [
        'title'      => 'Detalles',
        'post_types' => 'listings',

        'fields' => [
            [
                'name'       => 'ID MLS',
                'id'         => 'mls_id',
                'type'       => 'text',
                'required'        => true,
                'desc'    => 'El ID asignado por MLS'
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
                'required'=> true,
                'size' => 30,
            ],
            [
                'name'        => 'Tipo de Propiedad',
                'id'          => 'property_type',
                'type'        => 'select',
                'required'        => true,
                'options'         => array(
                    'A'  => 'Condominios',
                    'B'    => 'Casas y Villas',
                    'E'     => 'Lotes',
                    'F'     => 'Interés Común',
                    'G'     => 'Negocios',
                    'H'     => 'Fraccional',
                    'I'     => 'Multi Familiar',
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
                'name'            => 'Disponibilidad',
                'id'              => 'avaliable',
                'type'            => 'select',
                'required'        => true,
                // Array of 'value' => 'Label' pairs
                'options'         => array(
                    'Active'  => 'Disponible',
                    'Pending'    => 'Apartado',
                    'Closed'     => 'Vendido',
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
                'name'       => 'Estado',
                'id'         => 'state',
                'type'       => 'text',
                'required'        => true,
            ],
            [
                'name'       => 'Ciudad',
                'id'         => 'city',
                'type'       => 'text',
                'required'        => true,
            ],
            [
                'name'       => 'Colonia',
                'id'         => 'community',
                'type'       => 'text',
                'required'   => true,
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
            [
                'name'    => 'Amenidades',
                'id'      => 'amenities',
                'type'    => 'textarea',
                'desc'    => 'Escriba todas las amenidades'
            ],
            
            // More fields.
        ],
    ];

     $meta_boxes[] = [
        
        'title' => 'Mapa de Google',
        'post_types' => 'listings',

        'fields' => [
            // Map field.
            [
                'name'       => 'Direcciones',
                'id'         => 'directions',
                'type'       => 'textarea',
                'required'        => false,
            ],
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