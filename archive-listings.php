<?php get_header(); ?>

    <section>

        <?php if ( have_posts() ): ?>

            <section class="py-5 mb-6" style="background-image:url('<?= get_template_directory_uri().'/assets/images/properties-bg.webp' ?>'); background-position:center;">
                <h1 class="text-center text-white my-5 fs-0 text-uppercase"><?php pll_e('Todas las Propiedades') ?></h1>
            </section>

            <div class="container">
                <?php get_search_form(); ?>
            </div>

            <div class="container row justify-content-center mt-5 mb-6">

                <?php while( have_posts() ): the_post();?>

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
                                <div class="fs-7 text-secondary fw-light"><?php rwmb_the_value('property_type'); ?></div>
                                <h2 class="fs-5 text-uppercase fw-bold mb-1 text-yellow"><?= get_the_title() ?></h2>
                                <p class="fw-light mb-1 fs-7 text-capitalize">
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
            
        <?php endif; ?>

    </section>

<?php get_footer(); ?>