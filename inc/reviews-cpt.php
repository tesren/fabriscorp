<?php
add_action( 'init', 'review_register_post_type' );

function review_register_post_type(){

    $labels = array(
        'menu_name'          =>  'Testimoniales' ,
        'name_admin_bar'     =>  'Testimonial' ,
        'add_new'            =>  'Agregar Testimonial' ,
        'add_new_item'       =>  'Agregar Testimonial' ,
        'new_item'           =>  'Nuevo Testimonial' ,
        'edit_item'          =>  'Editar Testimonial' ,
        'view_item'          =>  'Ver Testimonial' ,
        'update_item'        =>  'Actualizar Testimonial' ,
        'all_items'          =>  'Todos los Testimoniales' ,
        'search_items'       =>  'Buscar Testimoniales' ,
        'parent_item_colon'  =>  'Padre Testimonial' ,
        'not_found'          =>  'No se encontraron Testimoniales' ,
        'not_found_in_trash' =>  'No hay Testimoniales en la papelera' ,
        'name'               =>  'Testimoniales' ,
        'singular_name'      =>  'Testimonial' ,

    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'publicly_queryable' => true,
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
        'menu_icon' => 'dashicons-star-filled',
        'menu_positions' => 7,
        'exclude_from_search' => false

    );

    register_post_type('review', $args);

}

add_action('init', 'review_register_post_type');

add_filter( 'rwmb_meta_boxes', 'reviews_register_meta_boxes' );

function reviews_register_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = [
        'title'   => 'Información del Testimonial' ,
        'post_types' => 'review',
        
        'fields'  => [
            [
                'type' =>   'text',
                'name' =>   'Nombre',
                'id'   =>   'review_name',
                'required' =>   true,
            ],
            [
                'type' =>   'text',
                'name' =>   'Ocupación o empresa',
                'id'   =>   'review_position',
            ],
            [
                'type' =>   'textarea',
                'name' =>   'Testimonial del Cliente',
                'id'   =>   'review_content',
                'desc' =>   'Testimonial del Cliente',
                'required' =>   true,
                'rows' => 8,
            ],
        ],
    ];

    return $meta_boxes;
}