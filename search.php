<?php

    get_header();

    $property_types_array = [
        'A' => 'condominios',
        'B' => 'casas',
        'E' => 'lotes',
        'F' => 'interes-comun',
        'G' => 'negocios',
        'H' => 'fraccional',
        'I' => 'multi-familiar'
    ];

    $zones = get_terms( array(
        'taxonomy'          => 'regiones',
        'parent'            => 0,
        'hide_empty'        => false,
    ) );

    if( isset($_GET['zona']) and !empty($_GET['zona'])){
        $zone = $_GET['zona'];

        if($zone == 'Puerto Vallarta' or $zone == 'Riviera Nayarit'){
            $zone_query = [
                'key' => 'city',
                'value' => $zone,
                'compare' => 'LIKE'
            ];
        }
        else{
            $zone_query = [
                'key' => 'community',
                'value' => $zone,
                'compare' => 'LIKE'
            ];
        }
        
        $zone_tax_query = [
            'taxonomy' => 'regiones',
            'field' => 'name',
            'include_children' => true,
            'operator' => 'LIKE',
            'value' => $zone,
        ];

    }else{
        $zone_query = [
            'key' => 'community',
            'value' => 'Nave Espacial',
            'compare' => '!='
        ];

        $zone_tax_query = [
            'taxonomy' => 'regiones',
            'field' => 'name',
            'include_children' => true,
            'operator' => '!=',
            'value' => 'Marte'
        ];
    }

    if( isset( $_GET['tipo_propiedad'] ) and !empty( $_GET['tipo_propiedad'] ) ){
        $property_type = $_GET['tipo_propiedad'];

        $property_type_query = [
            'key' => 'property_type',
            'value' => $property_type,
            'compare' => 'LIKE'
        ];

        $taxonomy_name = 'property_type';
        $term = get_term_by('slug', $property_types_array[$property_type], $taxonomy_name);
        $taxonomy_slug = $term->slug;

        $ptype_tax_query = [
            'taxonomy' => 'property_type',
            'field' => 'slug',
            'terms' => $taxonomy_slug,
        ];

    }else{
        $property_type_query = [
            'key' => 'property_type',
            'value' => 'Nave Espacial',
            'compare' => '!='
        ];

        $property_types = get_terms( array(
            'taxonomy'          => 'property_type',
            'parent'            => 0,
            'hide_empty'        => false,
        ) );

        $type_slugs = [];

        foreach ($property_types as $type){
            array_push($type_slugs, $type->slug);
        } 

        $ptype_tax_query = [
            'taxonomy' => 'property_type',
            'field' => 'slug',
            'terms' => $type_slugs,
        ];
    }

    if( isset( $_GET['recamaras'] ) and !empty( $_GET['recamaras'] ) ){
        $bedrooms = $_GET['recamaras'];

        $bedrooms_array_query = [
            'key' => 'bedrooms',
            'value' => $bedrooms,
            'compare' => '='
        ];
    }else{

        $bedrooms_array_query = [
            'key' => 'bedrooms',
            'value' => 9999,
            'compare' => '!='
        ];

    }

    
    $min_price = (int) $_GET['min_price'] ?? 0;
    
    $max_price = (int) $_GET['max_price'] ?? 99999999;
    

    //listings exclusivos
    $properties = get_posts(array(
        'post_type' => 'propiedad-en-venta',
        'numberposts' => -1,
        'meta_query' =>[
            [
                'key' => 'price_usd',
                'type' => 'NUMERIC',
                'value' => array($min_price, $max_price),
                'compare' => 'BETWEEN'
            ],
            $bedrooms_array_query,
        ],
        'tax_query' => [
            $ptype_tax_query,
            $zone_tax_query,
        ]
    ));

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    //listings de flex
    $args = array(
        'post_type' => 'listings',
        'posts_per_page' => 12,
        'paged' => $paged,
        'meta_query' => [
            $property_type_query,
            $bedrooms_array_query,
            $zone_query,
            [
                'key' => 'price_usd',
                'type' => 'NUMERIC',
                'value' => array($min_price, $max_price),
                'compare' => 'BETWEEN'
            ],
            [
                'key' => 'avaliable',
                'value' => 'Active',
                'compare' => 'LIKE'
            ],
        ],
        
    );
    
    $query = new WP_Query($args);

    $temp_query = $wp_query;
    $wp_query = NULL;
    $wp_query = $query;
?>

    <?php if($query -> have_posts() ):?>

        <h1 class="fs-2 blue-text fw-bold text-center mt-5 mb-1"><?php pll_e('Resultados de la Busqueda');?></h1>
        <hr class="col-10 col-lg-3 mx-auto mt-0 mb-5">

        <div class="container mb-5">
            <?php echo get_search_form();?>
        </div>

        <div class="container row mb-5">

            <!-- Propiedades Exclusivas -->
            <?php if( count($properties) > 0 and $paged == 1 ): ?>
                <?php foreach($properties as $listing): ?>
                    <a href="<?= get_the_permalink($listing->ID) ?>" class="col-12 col-lg-4 position-relative mb-3 link-dark text-decoration-none">

                        <div class="shadow-4 rounded-4">
                            <?php $imgs = rwmb_meta('listing_gallery', ['size'=>'medium_large', 'limit'=>1], $listing->ID ); ?>
                            <img src="<?= $imgs[0]['url'] ?>" alt="<?= get_the_title($listing->ID) ?>" class="w-100 rounded-top-4" style="height:280px; object-fit:cover;" loading="lazy" >

                            <div class="position-absolute top-0 start-0 shadow-4 mt-2 ms-4">
                                <div class="position-relative">

                                <div class="position-relative z-3 bg-white rounded-pill px-3 py-1">$<?= number_format($listing->price) ?></div>

                                <div class="position-absolute rounded-pill bg-yellow py-1 ps-5 pe-3 z-2 top-0" style="right:-60px;">
                                    MXN
                                </div>

                                </div>
                            </div>

                            <?php
                                if($listing->avaliable == 'Disponible'){
                                $status_classes = 'bg-success';
                                }elseif( $listing->avaliable == 'Apartado' ){
                                $status_classes = 'bg-warning';
                                }else{
                                $status_classes = 'bg-danger';
                                }
                            ?>

                            <div class="position-absolute end-0 shadow-4 me-4 px-3 py-1 text-white rounded-pill <?= $status_classes ?>" style="top:235px;">
                                <?= $listing->avaliable ?>
                            </div>

                            <div class="p-3">
                                <div class="fs-7 text-secondary fw-light"><?php pll_e(get_property_type($listing->ID, 'property_type')) ?></div>
                                <h2 class="fs-5 text-uppercase fw-bold mb-1 text-yellow"><?= get_the_title($listing->ID) ?></h2>
                                <p class="fw-light mb-1"><i class="fa-solid text-yellow fa-location-dot"></i> <?php get_list_terms($listing->ID, 'regiones') ?></p>

                                <div class="d-flex fs-6 fw-light">

                                <?php if( isset($listing->bedrooms) ): ?>
                                    <div class="me-3">
                                    <i class="fa-solid fa-bed"></i> <?= $listing->bedrooms ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( isset($listing->bathrooms) ): ?>
                                    <div class="me-3">
                                    <i class="fa-solid fa-bath"></i> <?= $listing->bathrooms ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( isset($listing->construction) ): ?>
                                    <div class="me-3">
                                    <i class="fa-solid fa-house"></i> <?= number_format($listing->construction, 2) ?>m²
                                    </div>
                                <?php endif; ?>

                                <?php if( isset($listing->lot_area) ): ?>
                                    <div class="me-3">
                                    <i class="fa-solid fa-maximize"></i> <?= $listing->lot_area ?>m²
                                    </div>
                                <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    </a>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Propiedades de Flex -->
            <?php while($query->have_posts() ) : $query->the_post(); ?>

                <a href="<?= get_the_permalink() ?>" class="col-12 col-lg-4 position-relative mb-3 link-dark text-decoration-none">

                    <div class="shadow-4 rounded-4">
                        <?php $img = get_portrait_url(rwmb_meta('mls_id')); ?>

                        <img src="<?= $img ?>" alt="<?= get_the_title() ?>" class="w-100 rounded-top-4" style="height:280px; object-fit:cover;">

                        <div class="position-absolute top-0 start-0 mt-2 ms-4">
                            <div class="position-relative">

                            <?php $price_usd = rwmb_meta('price_usd') ?>

                            <div class="position-relative z-3 bg-white rounded-pill shadow-4 px-3 py-1">$<?= number_format($price_usd) ?></div>

                            <div class="position-absolute rounded-pill bg-yellow py-1 ps-5 pe-3 z-2 top-0" style="right:-60px;">
                                USD
                            </div>

                            </div>
                        </div>

                        <?php
                            $status = rwmb_meta('avaliable');

                            if($status == 'Active'){
                                $status_classes = 'bg-success';
                            }elseif( $status == 'Pending' ){
                                $status_classes = 'bg-warning';
                            }else{
                                $status_classes = 'bg-danger';
                            }
                        ?>

                        <div class="position-absolute end-0 shadow-4 me-4 px-3 py-1 text-white rounded-pill <?= $status_classes ?>" style="top:235px;">
                            <?= $status ?>
                        </div>

                        <div class="p-3">
                            <div class="fs-7 text-secondary fw-light"><?php pll_e(rwmb_the_value('property_type', [], get_the_ID(), false)); ?></div>
                            <h2 class="fs-5 text-uppercase fw-bold mb-1 text-yellow"><?= get_the_title() ?></h2>
                            <p class="fw-light mb-1">
                                <i class="fa-solid text-yellow fa-location-dot"></i> <?= rwmb_meta('community') ?>, <?= rwmb_meta('city') ?>, <?= rwmb_meta('state') ?>
                            </p>

                            <div class="d-flex fs-6 fw-light">

                            <?php if( rwmb_meta('bedrooms') ): ?>
                                <div class="me-3">
                                <i class="fa-solid fa-bed"></i> <?= rwmb_meta('bedrooms') ?>
                                </div>
                            <?php endif; ?>

                            <?php if( rwmb_meta('bathrooms') ): ?>
                                <div class="me-3">
                                <i class="fa-solid fa-bath"></i> <?= rwmb_meta('bathrooms') ?>
                                </div>
                            <?php endif; ?>

                            <?php if( rwmb_meta('construction') ): ?>
                                <div class="me-3">
                                <i class="fa-solid fa-house"></i> <?= number_format(rwmb_meta('construction'), 2) ?>m²
                                </div>
                            <?php endif; ?>

                            <?php if( rwmb_meta('lot_area') ): ?>
                                <div class="me-3">
                                <i class="fa-solid fa-maximize"></i> <?= number_format(rwmb_meta('lot_area'), 2) ?>m²
                                </div>
                            <?php endif; ?>

                            </div>

                        </div>

                    </div>

                </a>
                
            <?php endwhile;?>
        </div>

        <?php the_posts_pagination(array(
            'prev_text' => '<<',
            'next_text' => '>>',
        )); ?>

    <?php else: ?>

        <div class="text-center my-5">
            <h1 class="fs-1 blue-text"><?php pll_e('Lo sentimos, no hay resultados'); ?></h1>
            <h2 class="fs-4 fw-light gold-text"><?php pll_e('Pero estas propiedades podrían interesarte'); ?></h2>
        </div>

        <div class="container mb-5">
            <?php echo get_search_form();?>
        </div>

        <?php
            $more_listings = get_posts(array(
                'post_type'      => 'listings',
                'numberposts'    => 150,
                'orderby'        => 'rand', // Ordenar de forma aleatoria
            ));
        ?>

        <div class="container row justify-content-evenly mb-6">
            <?php $i=0; foreach($more_listings as $listing): ?>

                <a href="<?= get_the_permalink($listing->ID) ?>" class="col-12 col-lg-4 position-relative mb-3 link-dark text-decoration-none">

                    <div class="shadow-4 rounded-4">
                        <?php $img = get_portrait_url(rwmb_meta('mls_id', [], $listing->ID)); ?>

                        <img src="<?= $img ?>" alt="<?= get_the_title($listing->ID) ?>" class="w-100 rounded-top-4" style="height:280px; object-fit:cover;">

                        <div class="position-absolute top-0 start-0 mt-2 ms-4">
                            <div class="position-relative">

                            <?php $price_usd = $listing->price_usd ?>

                            <div class="position-relative z-3 bg-white rounded-pill shadow-4 px-3 py-1">$<?= number_format($price_usd) ?></div>

                            <div class="position-absolute rounded-pill bg-yellow py-1 ps-5 pe-3 z-2 top-0" style="right:-60px;">
                                USD
                            </div>

                            </div>
                        </div>

                        <?php
                            $status = $listing->avaliable;

                            if($status == 'Active'){
                                $status_classes = 'bg-success';
                            }elseif( $status == 'Pending' ){
                                $status_classes = 'bg-warning';
                            }else{
                                $status_classes = 'bg-danger';
                            }
                        ?>

                        <div class="position-absolute end-0 shadow-4 me-4 px-3 py-1 text-white rounded-pill <?= $status_classes ?>" style="top:235px;">
                            <?= $status ?>
                        </div>

                        <div class="p-3">
                            <div class="fs-7 text-secondary fw-light"><?php rwmb_the_value('property_type', [], $listing->ID); ?></div>
                            <h2 class="fs-5 text-uppercase fw-bold mb-1 text-yellow"><?= get_the_title($listing->ID) ?></h2>
                            <p class="fw-light mb-1">
                                <i class="fa-solid text-yellow fa-location-dot"></i> <?= $listing->city ?>, <?= $listing->state ?>
                            </p>

                            <div class="d-flex fs-6 fw-light">

                            <?php if( $listing->bedrooms ): ?>
                                <div class="me-3">
                                <i class="fa-solid fa-bed"></i> <?= $listing->bedrooms ?>
                                </div>
                            <?php endif; ?>

                            <?php if( $listing->bathrooms ): ?>
                                <div class="me-3">
                                <i class="fa-solid fa-bath"></i> <?= $listing->bathrooms ?>
                                </div>
                            <?php endif; ?>

                            <?php if( $listing->construction ): ?>
                                <div class="me-3">
                                <i class="fa-solid fa-house"></i> <?= $listing->construction ?>m²
                                </div>
                            <?php endif; ?>

                            <?php if( $listing->lot_area ): ?>
                                <div class="me-3">
                                <i class="fa-solid fa-maximize"></i> <?= $listing->lot_area ?>m²
                                </div>
                            <?php endif; ?>

                            </div>

                        </div>

                    </div>

                </a>

                <?php if($i==14){break;} ?>

            <?php $i++; endforeach; ?>
        </div>
       

    <?php endif; ?>

    <?php 
        wp_reset_postdata(); 
        // Reset main query object
        $wp_query = NULL;
        $wp_query = $temp_query;
    ?>

    <?php echo  get_template_part( 'partials/content', 'mls-disclaimer' ); ?>

<?php get_footer(); ?>