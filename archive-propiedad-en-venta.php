<?php 
    //listings de flex
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args = array(
        'post_type' => 'propiedad-en-venta',
        'posts_per_page' => 12,
        'paged' => $paged,
        'order'          => 'ASC',
        'meta_key'       => 'priority',
        'orderby'        => 'meta_value_num',
        /* 'meta_query' => array(
            array(
                'key' => 'avaliable',
                'value' => 'Vendido',
                'compare' => '!='
            ),
        ), */
      );

    $query = new WP_Query($args);

    $temp_query = $wp_query;
    $wp_query = NULL;
    $wp_query = $query;
    
    get_header(); 

?>

    <section>

        <?php if ($query ->  have_posts() ): ?>

            <section class="py-5 mb-6" style="background-image:url('<?= get_template_directory_uri().'/assets/images/properties-bg.webp' ?>'); background-position:center;">
                <h1 class="text-center text-white my-5 fs-0 text-uppercase"><?php pll_e('Propiedades de lujo') ?></h1>
            </section>

            <div class="container mb-6">
                <?php get_search_form(); ?>
            </div>

            <div class="container row justify-content-center mb-6">

                <?php while( $query -> have_posts() ): $query -> the_post();?>

                    <a href="<?= get_the_permalink() ?>" class="col-12 col-lg-4 position-relative mb-3 link-dark text-decoration-none">

                        <div class="shadow-4 rounded-4">
                            <?php $imgs = rwmb_meta('listing_gallery', ['size'=>'medium_large', 'limit'=>1] ); ?>
                            <img src="<?= $imgs[0]['url'] ?>" alt="<?= get_the_title() ?>" class="w-100 rounded-top-4" style="height:280px; object-fit:cover;">

                            <div class="position-absolute top-0 start-0 shadow-4 mt-2 ms-4">
                                <div class="position-relative">

                                <?php 
                                    $price_mxn = rwmb_meta('price');
                                    $price_usd = rwmb_meta('price_usd');
                                    
                                    if( isset($price_mxn) and $price_mxn != 0 ){
                                        $price = (double) $price_mxn;
                                        $currency = 'MXN';
                                    }elseif( isset($price_usd) and $price_usd != 0 ){
                                        $price = (double) $price_usd;
                                        $currency = 'USD';
                                    }else{
                                        $price = false;
                                    }
                                ?>

                                <?php if( $price ): ?>
                                    <div class="position-relative z-3 bg-white rounded-pill shadow-4 px-3 py-1">$<?= number_format($price, 2) ?></div>

                                    <div class="position-absolute rounded-pill bg-yellow py-1 ps-5 pe-3 z-2 top-0" style="right:-60px;">
                                    <?= $currency ?>
                                    </div>

                                <?php endif; ?>

                                </div>
                            </div>

                            <?php
                                $status = rwmb_meta('avaliable');

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
                                <div class="fs-7 text-secondary fw-light"><?php pll_e(get_property_type(get_the_ID(), 'property_type')) ?></div>
                                <h2 class="fs-5 text-uppercase fw-bold mb-1 text-yellow"><?= get_the_title() ?></h2>
                                <p class="fw-light mb-1">
                                    <i class="fa-solid text-yellow fa-location-dot"></i> <?php get_list_terms(get_the_ID(), 'regiones') ?>
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
                                    <i class="fa-solid fa-house"></i> <?= rwmb_meta('construction') ?>m²
                                    </div>
                                <?php endif; ?>

                                <?php if( rwmb_meta('lot_area') ): ?>
                                    <div class="me-3">
                                    <i class="fa-solid fa-maximize"></i> <?= rwmb_meta('lot_area') ?>m²
                                    </div>
                                <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    </a>

                <?php endwhile; ?>

            </div>

            <?php the_posts_pagination( array(
                'prev_text' => '<<',
                'next_text' => '>>',
            ) ); ?>

            <?php echo  get_template_part( 'partials/content', 'mls-disclaimer' ); ?>

            
        <?php endif; ?>

    </section>

    <?php
        wp_reset_postdata(); 
        // Reset main query object
        $wp_query = NULL;
        $wp_query = $temp_query;
    ?>

<?php get_footer(); ?>