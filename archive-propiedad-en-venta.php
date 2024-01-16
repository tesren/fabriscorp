<?php get_header(); ?>

    <section>

        <?php if ( have_posts() ): ?>

            <section class="py-5 mb-6" style="background-image:url('<?= get_template_directory_uri().'/assets/images/properties-bg.webp' ?>'); background-position:center;">
                <h1 class="text-center text-white my-5 fs-0 text-uppercase"><?php pll_e('Propiedades de lujo') ?></h1>
            </section>

            <div class="container row justify-content-center mb-6">

                <?php while( have_posts() ): the_post();?>

                    <a href="<?= get_the_permalink() ?>" class="col-12 col-lg-4 position-relative mb-3 link-dark text-decoration-none">

                        <?php $imgs = rwmb_meta('listing_gallery', ['size'=>'medium_large', 'limit'=>1] ); ?>
                        <img src="<?= $imgs[0]['url'] ?>" alt="<?= get_the_title() ?>" class="w-100" style="height:280px; object-fit:cover;">

                        <div class="position-absolute top-0 end-0 bg-yellow px-3 py-1 shadow-4 mt-2 me-4">
                            <?php get_property_type(get_the_ID(), 'property_type') ?>
                        </div>

                        <div class="p-2">
                            <h2 class="fs-5 text-uppercase fw-bold mb-1"><?= get_the_title() ?></h2>
                            <p><?php get_list_terms(get_the_ID(), 'regiones') ?></p>
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