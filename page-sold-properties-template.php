<?php
 /*
  Template Name: Sold Properties Template
 */


//listings exclusivos
$sold_properties = get_posts(array(
    'post_type' => 'propiedad-en-venta',
    'numberposts' => -1,
    'meta_query' => array(
        array(
            'key' => 'avaliable',
            'value' => 'Vendido',
            'compare' => '='
        ),
    ),
));


get_header();

?>


<section>

    <?php if ( count($sold_properties)>0 ): ?>

        <section class="py-5 mb-6" style="background-image:url('<?= get_template_directory_uri().'/assets/images/properties-bg.webp' ?>'); background-position:center;">
            <h1 class="text-center text-white my-5 fs-0 text-uppercase"><?php pll_e('Propiedades Vendidas') ?></h1>
        </section>

        <div class="container mb-6">
            <?php get_search_form(); ?>
        </div>

        <div class="container row justify-content-center mb-6">

            <?php foreach($sold_properties as $listing): ?>

                <a href="<?= get_the_permalink($listing->ID) ?>" class="col-12 col-lg-4 position-relative mb-3 link-dark text-decoration-none">

                    <div class="shadow-4 rounded-4">

                        <?php $imgs = rwmb_meta('listing_gallery', ['size'=>'medium_large', 'limit'=>1], $listing->ID ); ?>
                        <img src="<?= $imgs[0]['url'] ?>" alt="<?= get_the_title() ?>" class="w-100 rounded-top-4" style="height:280px; object-fit:cover;">

                        <div class="position-absolute top-0 start-0 shadow-4 mt-2 ms-4">
                            <div class="position-relative">

                            <?php $mxn_price = (double) $listing->price; ?>

                            <div class="position-relative z-3 bg-white rounded-pill px-3 py-1">$<?= number_format($mxn_price) ?></div>

                            <div class="position-absolute rounded-pill bg-yellow py-1 ps-5 pe-3 z-2 top-0" style="right:-60px;">
                                MXN
                            </div>

                            </div>
                        </div>

                        <?php
                            $status = $listing->avaliable;

                            if($status == 'Disponible'){
                                $status_classes = 'bg-success';
                            }elseif( $status == 'Apartado' ){
                                $status_classes = 'bg-warning';
                            }else{
                                $status_classes = 'bg-danger';
                            }
                        ?>

                        <div class="position-absolute end-0 shadow-4 me-4 px-3 py-1 text-white rounded-pill <?= $status_classes ?>" style="top:235px;">
                            <?php pll_e($status) ?>
                        </div>

                        <div class="p-3">
                            <div class="fs-7 text-secondary fw-light"><?php pll_e(get_property_type($listing->ID, 'property_type')) ?></div>
                            <h2 class="fs-5 text-uppercase fw-bold mb-1 text-yellow"><?= get_the_title($listing->ID) ?></h2>
                            <p class="fw-light mb-1">
                                <i class="fa-solid text-yellow fa-location-dot"></i> <?php get_list_terms($listing->ID, 'regiones') ?>
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

                            <?php if( isset($listing->construction) ): ?>
                                <div class="me-3">
                                <i class="fa-solid fa-house"></i> <?= $listing->construction ?>m²
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

        </div>

        
    <?php endif; ?>

</section>


<?php get_footer(); ?>