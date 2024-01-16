<?php
    $obj_id = get_queried_object_id();
    $term = get_term_by('id', $obj_id, 'property_type', OBJECT);
    get_header(); 
?>

    <section>

        <?php if ( have_posts() ): ?>

            <h1 class="fs-2 blue-text fw-bold text-center mt-6 mb-1">Todas las <?= $term->name ?> en venta</h1>
            <hr class="col-11 col-lg-4 mx-auto mt-0 mb-6">

            <div class="row justify-content-center mb-6">

                <?php while( have_posts() ): the_post();?>

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

                                            <p class="card-text"><small class="text-body-secondary">Última actualización: <?= get_the_date('d/m/Y');?></small></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </a>
                        
                    </div>

                <?php endwhile; ?>

            </div>
        <?php else: ?>
            
            <div class="text-center my-5">
                <h1 class="fs-1 blue-text"><?php pll_e('Lo sentimos, por el momento no hay propiedades'); ?></h1>
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

                                            <p class="card-text"><small class="text-body-secondary">Última actualización: <?= get_the_date('d/m/Y', $listing->ID);?></small></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </a>
                        
                    </div>

                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </section>

<?php get_footer(); ?>