<?php
add_action( 'init', 'messages_register_post_type' );

function messages_register_post_type(){

    $labels = array(
        'menu_name'          =>  'Mensajes' ,
        'name_admin_bar'     =>  'Mensaje' ,
        'add_new'            =>  'Agregar Mensaje' ,
        'add_new_item'       =>  'Agregar Mensaje' ,
        'new_item'           =>  'Nuevo Mensaje' ,
        'edit_item'          =>  'Editar Mensaje' ,
        'view_item'          =>  'Ver Mensaje' ,
        'update_item'        =>  'Actualizar Mensaje' ,
        'all_items'          =>  'Todos los Mensajes' ,
        'search_items'       =>  'Buscar Mensajes' ,
        'parent_item_colon'  =>  'Padre Mensaje' ,
        'not_found'          =>  'No se encontraron Mensajes' ,
        'not_found_in_trash' =>  'No hay Mensajes en la papelera' ,
        'name'               =>  'Mensajes' ,
        'singular_name'      =>  'Mensaje' ,

    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' =>  false,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array(
            'title',
            //'editor',
            //'excerpt',
            //'thumbnail',
            'revisions',
        ),
        'menu_icon' => 'dashicons-buddicons-pm',
        'menu_positions' => 7,
        'exclude_from_search' => false

    );

    register_post_type('mensaje', $args);

}

add_action('init', 'messages_register_post_type');

add_filter( 'rwmb_meta_boxes', 'messages_register_meta_boxes' );

function messages_register_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = [
        'title'   => 'Información del Mensaje' ,
        'post_types' => 'mensaje',
        
        'fields'  => [
            [
                'type' =>   'text',
                'name' =>   'Nombre',
                'id'   =>   'contact_name',
                'desc' =>   'Nombre del Lead',
            ],
            [
                'type' =>   'text',
                'name' =>   'Email',
                'id'   =>   'contact_email',
                'desc' =>   'Email del Lead',
            ],
            [
                'type' =>   'number',
                'name' =>   'Teléfono',
                'id'   =>   'contact_phone',
                'desc' =>   'Teléfono del Lead',
            ],
            [
                'type' =>   'textarea',
                'name' =>   'Mensaje del Lead',
                'id'   =>   'contact_message',
                'desc' =>   'Mensaje del cliente',
            ],
        ],
    ];

    return $meta_boxes;
}