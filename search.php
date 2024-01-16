<?php

    $regiones = get_terms( array(
        'taxonomy'          => 'regiones',
        'parent'            => 0,
        'hide_empty'        => false,
    ) );

    $propertiesType = get_terms( array(
        'taxonomy'          => 'property_type',
        'parent'            => 0,
        'hide_empty'        => false,
    ) );

    if($_GET['regiones_s'] && !empty($_GET['regiones_s']))
    {
        $regiones_s = $_GET['regiones_s'];

    }else{
        $regiones_s = array(); 

        //Recuerda que si no tiene parent no funciona la busqueda
        foreach($regiones as &$category):
            $childrenTerms =  get_term_children( $category->term_id, 'regiones' );

            foreach($childrenTerms as $child) :     
                $term = get_term_by( 'id', $child, 'regiones');
                array_push($regiones_s, $term->slug);
            endforeach; 

         endforeach;
    }

    if($_GET['type_s'] && !empty($_GET['type_s']))
    {
        $pType = $_GET['type_s'];
    }
    else{
        $pType = array();

        foreach ($propertiesType as $propertyType){
            array_push($pType, $propertyType->slug);
        } 
    }


    get_header();

    $developments = get_posts(array(
        'post_type' => 'desarrollos',
        'numberposts' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'property_type',
                'field'    => 'slug',
                'terms'    => $pType,
            ),
            array(
                'taxonomy' => 'regiones',
                'field'    => 'slug',
                'include_children' => true,
                'terms'    => $regiones_s,
            ),
        ),
    ));

    
    $args = array(
        'post_type' => 'propiedad-en-venta',
        'posts_per_page' => 9,
        'meta_query' => array(
            array(
                'key' => 'avaliable',
                'value' => 'Disponible',
                'compare' => 'LIKE'
            ),
        ),
        'tax_query' => array(
            array(
                'taxonomy' => 'property_type',
                'field'    => 'slug',
                'terms'    => $pType,
            ),
            array(
                'taxonomy' => 'regiones',
                'field'    => 'slug',
                'include_children' => true,
                'terms'    => $regiones_s,
            ),
        ),
    );
    

    $query = new WP_Query($args);
    
?>

    <?php// var_dump($query); ?>

    <?php if($query -> have_posts() ):?>

        <h1 class="fs-2 blue-text fw-bold text-center mt-5 mb-1"><?php pll_e('Resultados de la Busqueda');?></h1>
        <hr class="col-10 col-lg-3 mx-auto mt-0 mb-5">

        <div class="row justify-content-evenly">

            <div class="col-12 col-lg-8 mb-5">
                <!-- Formulario de busqueda -->
                <?php echo get_search_form();?>
            </div>

            <?php while($query ->have_posts() ) : $query ->the_post(); ?>

                <div class="col-11 col-lg-10 col-xl-9 mb-4 mb-lg-5 shadow-4 px-0 rounded-2 blog-card">

                    <a href="<?= get_the_permalink(); ?>" class="text-decoration-none">
                        <div class="card w-100 text-dark fw-normal position-relative">

                            <div class="badge bg-blue position-absolute top-0 start-0 ms-3 mt-3 z-3">
                                <?php get_property_type(get_the_ID() , 'property_type') ?>
                            </div>

                            <div class="row g-0">

                                <?php $images = rwmb_meta('listing_gallery', ['size'=>'medium-large', 'limit'=>1]) ;?>
                                <div class="col-md-4">
                                    <img src="<?= $images[0]['url'] ?>" class="w-100 rounded-start" alt="<?= get_the_title();?>" style="height:340px; object-fit:cover;">
                                </div>

                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h2 class="fw-bold blue-text mb-1"><?= get_the_title();?></h2>
                                        <h3 class="fw-light gold-text fs-5 mb-3"><?php get_list_terms(get_the_ID(), 'regiones'); ?></h3>

                                        <p class="card-text"><?= get_the_excerpt();?></p>

                                        <div class="d-flex fs-5 my-2">
                                            <div class="gold-text">
                                                <img width="24px" src="<?php echo get_template_directory_uri();?>/assets/icons/bed-blue.svg" alt="">
                                                <?= rwmb_meta('bedrooms'); ?>
                                            </div>

                                            <div class="gold-text">
                                                <img width="24px" src="<?php echo get_template_directory_uri();?>/assets/icons/bathtub-blue.svg" alt="" class="ms-3">
                                                <?= rwmb_meta('bathrooms'); ?>                                    
                                            </div>

                                            <div class="gold-text ms-3">
                                                <span class="blue-text"><?= rwmb_meta('construction'); ?></span>m²                                 
                                            </div>
                                        </div>

                                        <div class="fs-2 fw-bold blue-text">
                                            $<?= number_format(rwmb_meta('price')) ?> <span class="fs-5"><?= rwmb_meta('currency') ?></span>
                                        </div>

                                        <p class="card-text"><small class="text-body-secondary"><?php pll_e('Última actualización');?>: <?= get_the_date('d/m/Y');?></small></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                    
                </div>
                
            <?php endwhile;?>
        </div>

        <?php the_posts_pagination(); ?>

    <?php else: ?>

        <div class="text-center my-5">
            <h1 class="fs-1 blue-text"><?php pll_e('Lo sentimos, no hay resultados'); ?></h1>
            <h2 class="fs-4 fw-light gold-text"><?php pll_e('Pero estas propiedades podrían interesarte'); ?></h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 mb-5">
                <!-- Formulario de busqueda -->
                <?php echo get_search_form();?>
            </div>
        </div>

        <?php
            $more_listings =  get_posts(array('post_type' => 'propiedad-en-venta','numberposts' => 3,)); 
        ?>

        <div class="row justify-content-evenly">
            <?php foreach($more_listings as $listing): ?>

                <div class="col-11 col-lg-10 col-xl-9 mb-4 mb-lg-5 shadow-4 px-0 rounded-2 blog-card">

                    <a href="<?= get_the_permalink($listing->ID); ?>" class="text-decoration-none">
                        <div class="card w-100 text-dark fw-normal position-relative">

                            <div class="badge bg-blue position-absolute top-0 start-0 ms-3 mt-3 z-3">
                                <?php get_property_type($listing->ID , 'property_type') ?>
                            </div>

                            <div class="row g-0">

                                <?php $images = rwmb_meta('listing_gallery', ['size'=>'medium-large', 'limit'=>1], $listing->ID) ;?>
                                <div class="col-md-4">
                                    <img src="<?= $images[0]['url'] ?>" class="w-100 rounded-start" alt="<?= get_the_title($listing->ID);?>" style="height:340px; object-fit:cover;">
                                </div>

                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h2 class="fw-bold blue-text mb-1"><?= get_the_title($listing->ID);?></h2>
                                        <h3 class="fw-light gold-text fs-5 mb-3"><?php get_list_terms($listing->ID, 'regiones'); ?></h3>

                                        <p class="card-text"><?= get_the_excerpt($listing->ID);?></p>

                                        <div class="d-flex fs-5 my-2">
                                            <div class="gold-text">
                                                <img width="24px" src="<?php echo get_template_directory_uri();?>/assets/icons/bed-blue.svg" alt="">
                                                <?= $listing->bedrooms; ?>
                                            </div>

                                            <div class="gold-text">
                                                <img width="24px" src="<?php echo get_template_directory_uri();?>/assets/icons/bathtub-blue.svg" alt="" class="ms-3">
                                                <?= $listing->bathrooms; ?>                                    
                                            </div>

                                            <div class="gold-text ms-3">
                                                <span class="blue-text"><?= $listing->construction; ?></span>m²                                 
                                            </div>
                                        </div>

                                        <div class="fs-2 fw-bold blue-text">
                                            $<?= number_format($listing->price) ?> <span class="fs-5"><?= $listing->currency ?></span>
                                        </div>

                                        <p class="card-text"><small class="text-body-secondary"><?php pll_e('Última actualización');?>: <?= get_the_date('d/m/Y', $listing->ID);?></small></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                    
                </div>

            <?php endforeach; ?>
        </div>
       

    <?php endif; ?>

    <?php if($developments): ?>
        <h1 class="fs-2 blue-text fw-bold text-center mt-5 mb-0"><?php pll_e('Desarrollos Inmobiliarios');?></h1>
        <hr class="col-11 col-lg-3 mx-auto mt-0 mb-5">

        <div class="row justify-content-center">
            <?php foreach($developments as $dev): ?>
                <div class="col-11 col-lg-10 col-xl-9 mb-4 mb-lg-5 shadow-4 px-0 rounded-2 blog-card position-relative z-2">

                    <a href="<?= get_the_permalink($dev->ID); ?>" class="text-decoration-none">
                        <div class="card w-100 text-dark fw-normal position-relative">

                            <div class="badge bg-blue position-absolute top-0 start-0 ms-3 mt-3 z-3">
                                <?php get_property_type($dev->ID , 'property_type') ?>
                            </div>

                            <div class="row g-0">

                                <?php $images = rwmb_meta('gallery', ['size'=>'medium-large', 'limit'=>1], $dev->ID) ;?>
                                <div class="col-12 col-lg-7">
                                    <img src="<?= $images[0]['url'] ?>" class="w-100 rounded-start" alt="<?= get_the_title($dev->ID);?>" style="max-height:450px; object-fit:cover;">
                                </div>

                                <div class="col-12 col-lg-5">
                                    <div class="card-body">
                                        <h2 class="fw-bold blue-text mb-1 fs-1"><?= get_the_title($dev->ID);?></h2>
                                        <h3 class="fw-light gold-text fs-4 mb-3"><?php get_list_terms($dev->ID, 'regiones'); ?></h3>

                                        <p class="card-text fs-5"><?= get_the_excerpt($dev->ID);?></p>

                                        <div class="fs-4 fw-light blue-text">
                                            <?php pll_e('Precios desde')?>: 
                                            <span class="fw-bolder">
                                                $<?= number_format($dev->price) ?> <span class="fs-5"><?= $dev->currency ?></span>
                                            </span> 
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                    
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>

<?php get_footer(); ?>