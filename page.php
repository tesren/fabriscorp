<?php get_header(); ?>

    <article>

        <section class="position-relative mb-6">

            <img src="<?= get_template_directory_uri().'/assets/images/page-bg.webp' ?>" alt="Fabris Corp - <?= get_the_title() ?>" class="w-100" style="height:40vh; object-fit:cover;">

            <div class="row justify-content-center position-absolute top-0 start-0 h-100 text-white z-3">

                <div class="col-12 align-self-center">
                    <h1 class="text-uppercase fs-2 text-center"><?= get_the_title() ?></h1>
                </div>

            </div>

            <div class="fondo-oscuro"></div>

        </section>
  

        <?php if ( have_posts() ): ?>
                
            <?php while( have_posts() ): the_post();?>
                    
                <div class="container mb-6">
                    <?php the_content(); ?>
                </div>

            <?php endwhile; ?>
            
        <?php endif; ?>

        <!-- Seccion de contacto -->
        <div class="row justify-content-center py-5 text-white" style="background-image:url('<?= get_template_directory_uri().'/assets/images/bg-contact-section.webp' ?>');">

            <div class="col-12 col-lg-3 col-xxl-2 align-self-center border-end border-white px-4">
                <h5 class="text-uppercase fs-3"><?php pll_e('CONTÁCTANOS'); ?> <br> <?php pll_e('HOY MISMO') ?> </h5>
            </div>

            <div class="col-12 col-lg-5 px-4">
                <p class="fs-6 fw-light"><?php pll_e('Si estás interesado con comprar o rentar alguna de nuestras propiedades, te invitamos a hacer clic en el siguiente botón para que uno de nuestros asesores pueda brindarte atención especializada.') ?></p>
                <a href="<?= get_the_permalink(pll_get_post(1802)); ?>" class="btn btn-outline-light text-uppercase fw-light rounded-1"><?php pll_e('Mandar mensaje') ?></a>
            </div>

        </div>

    </article>

<?php get_footer(); ?>