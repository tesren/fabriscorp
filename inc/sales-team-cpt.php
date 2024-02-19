<?php

    /*
		==========================================
			CUSTOM PROPERTIES POST TYPE
		==========================================

    */
    
    function fabris_sales_team_cpt(){

        $labels = array(
            'name' => 'Agentes',
            'singular_name' => 'Agente',
            'add_new' => 'Agregar Agente',
            'all_items' => 'Todos los Agentes',
            'add_new_items' => 'Agregar Agente',
            'edit_item' => 'Editar Agente',
            'new_item' => 'Nuevo Agente',
            'view_item' => 'Ver Agente',
            'search_item' => 'Buscar Agente',
            'not_found' => 'Sin Resultados',
            'parent_item_colon' => 'Agente padre'

        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'publicly_queryable' =>  true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => true,
            'supports' => array(
                'title',
                //'editor',
                //'excerpt', 
                //'thumbnail',
                'revisions',
                //'comments'
            ),
            //'taxonomies' => array('category', 'post_tag'),
            'menu_icon' => 'dashicons-businessman',
            'menu_positions' => 5,
            'exclude_from_search' => false,
            'show_in_nav_menus' => false,

        );

        register_post_type('agentes', $args);

    }

    add_action('init', 'fabris_sales_team_cpt');
    
    add_filter( 'rwmb_meta_boxes', 'fabris_agents_register_meta_boxes' );

function fabris_agents_register_meta_boxes( $meta_boxes ) {
    
     $meta_boxes[] = [
        'title'      => 'Personal information',
        'post_types' => 'agentes',

        'fields' => [         
            [
                'name'  => 'Puesto',
                'desc'  => 'Posición de trabajo',
                'id'    => 'agent_position',
                'type'  => 'text',
                'required'=>true,
            ],
            [
                'name'  => 'Email',
                'desc'  => 'Correo electrónico',
                'id'    => 'agent_email',
                'type'  => 'text',
                'required'=>true,
            ],
            [
                'name'  => 'Teléfono',
                'desc'  => 'Teléfono móvil del agente',
                'id'    => 'agent_phone',
                'type'  => 'number',
                'required'=>true,
            ],
            [
                'name'  => 'Facebook',
                'desc'  => 'Ingresa el URL de tu perfil de Facebook',
                'id'    => 'agent_facebook',
                'type'  => 'text',
            ],
            [
                'name'  => 'Instagram',
                'desc'  => 'Ingresa el URL de tu perfil de Instagram',
                'id'    => 'agent_instagram',
                'type'  => 'text',
            ],
            /* [
                'name'  => 'Lenguajes',
                'desc'  => 'Ingrese los lenguajes que habla el Agent separados por ","',
                'id'    => 'agent_lang',
                'type'  => 'text',
                'required'=>true,
            ], */
            
            [
                'id'               => 'agent_picture',
                'name'             => 'Foto de perfil',
                'type'             => 'image_advanced',

                // Delete file from Media Library when remove it from post meta?
                // Note: it might affect other posts if you use same file for multiple posts
                'force_delete'     => false,

                // Maximum file uploads.
                'max_file_uploads' => 1,

                // Do not show how many files uploaded/remaining.
                'max_status'       => 'true',

                // Image size that displays in the edit page.
                'image_size'       => 'large',
            ],
            
            
            // More fields.
        ],
    ];



    return $meta_boxes;
}