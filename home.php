<?php get_header(); ?>

    <section>

        <div class="position-relative">
            <img src="<?= get_the_post_thumbnail_url( 30, 'full' ) ?>" alt="<?= get_the_title(30);?>" class="w-100" style="height:50vh; object-fit:cover;">

            <div class="fondo-oscuro"></div>

            <div class="row position-absolute top-0 start-0 h-100 z-2">
                <div class="col-12 text-center align-self-center">
                    <h1 class="fs-0 fw-bold text-center text-white">Blog</h1>
                </div>
            </div>

        </div>

        <?php if ( have_posts() ): ?>

            <h2 class="fs-2 blue-text fw-bold text-center mt-5 mb-1"><?php pll_e('Artículos Recientes');?></h2>
            <hr class="col-11 col-lg-3 mx-auto mt-0 mb-5">

            <div class="col-12 col-lg-10 mx-auto mb-6">
                <div class="row">
                    <?php while( have_posts() ): the_post();?>

                        <div class="col-12 col-lg-4 p-2 mb-4">

                            <article class="card rounded-0 w-100 shadow-4 blog-card">
                                <a href="<?= get_the_permalink(); ?>" class="text-decoration-none">
                                    <img src="<?= get_the_post_thumbnail_url( get_the_ID(), 'medium_large')?>" alt="<?= get_the_title(); ?>" class="w-100" style="height:270px; object-fit:cover;">
                                    
                                    <div class="bg-light card-body">
                                        <h3 class="fw-bold blue-text"><?= get_the_title(); ?></h3>
                                        <p class="text-dark fw-light"><?= get_the_excerpt(); ?></p>

                                        <div class="fw-light text-dark"><?= get_the_date('d-m-Y'); ?></div>
                                    </div>
                                </a>
                            </article>

                        </div>

                    <?php endwhile; ?>
                </div>
            </div>

            <?php the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( 'Anterior', 'textdomain' ),
                'next_text' => __( 'Siguiente', 'textdomain' ),
            ) ); ?>
            
        <?php endif; ?>

    </section>

<?php get_footer(); ?>