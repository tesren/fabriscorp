<?php
 /*
  Template Name: About us Template
 */

$agents = get_posts(array(
    'post_type' => 'agentes',
    'numberposts' => -1,
));

get_header();
?>

<article>

    <section class="position-relative mb-6">

        <img src="<?= get_template_directory_uri().'/assets/images/nosotros-bg.webp' ?>" alt="Fabris Corp - <?= get_the_title() ?>" class="w-100" style="height:40vh; object-fit:cover;">

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

    <?php if($agents): ?>

        <div class="container mb-6">
            <h3 class="text-center mb-0 text-yellow text-uppercase"><?php pll_e('Nuestro equipo de trabajo') ?></h3>
            <hr class="mx-auto mb-5 col-12 col-lg-4">

            <div class="row justify-content-center">
                <?php foreach($agents as $agent): ?>

                    <div class="col-12 col-lg-4 col-xxl-3 mb-4">

                        <?php $imgs = rwmb_meta('agent_picture', ['size'=>'medium_large', 'limit'=>1], $agent->ID) ?>

                        <div class="card shadow-4 rounded-4">
                            <img src="<?= $imgs[0]['url'] ?>" class="rounded-top-4" alt="<?= get_the_title($agent->ID) ?>" style="height:380px; object-fit:cover; object-position:top;">

                            <div class="card-body text-center">
                                <div class="fs-7 text-yellow"><?= $agent->agent_position ?></div>
                                <h4 class="card-title mb-2"><?= get_the_title($agent->ID) ?></h4>

                                <?php if( isset($agent->agent_phone) ): ?>
                                    <a href="tel:+52<?= $agent->agent_phone ?>" class="d-block text-decoration-none link-dark fw-light">
                                        <i class="fa-solid fa-phone"></i> <?= $agent->agent_phone ?>
                                    </a>
                                <?php endif; ?>

                                <?php if( isset($agent->agent_email) ): ?>
                                    <a href="mailto:<?= $agent->agent_email ?>" class="d-block text-decoration-none link-dark mb-2 fw-light">
                                        <i class="fa-regular fa-envelope"></i> <?= $agent->agent_email ?>
                                    </a>
                                <?php endif; ?>

                                <div class="d-flex justify-content-center fs-5">

                                    <?php if( isset($agent->agent_facebook) ): ?>
                                        <a href="<?= $agent->agent_facebook ?>" target="_blank" rel="noopener noreferrer" class="text-decoration-none text-yellow me-2">
                                            <i class="fa-brands fa-facebook"></i>
                                        </a>
                                    <?php endif; ?>

                                    <?php if( isset($agent->agent_instagram) ): ?>
                                        <a href="<?= $agent->agent_instagram ?>" target="_blank" rel="noopener noreferrer" class="text-decoration-none text-yellow me-2">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                    <?php endif; ?>

                                    <?php if( isset($agent->agent_phone) ): ?>
                                        <a href="https://wa.me/52<?= $agent->agent_phone ?>" target="_blank" rel="noopener noreferrer" class="text-decoration-none text-yellow me-2">
                                            <i class="fa-brands fa-whatsapp"></i>
                                        </a>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>
            </div>

            <hr class="mx-auto mb-5 col-12 col-lg-4">
        </div>

    <?php endif; ?>

    <!-- Seccion de contacto -->
    <div class="row justify-content-center py-5 text-white" style="background-image:url('<?= get_template_directory_uri().'/assets/images/bg-contact-section.webp' ?>');">

        <div class="col-12 col-lg-3 col-xxl-2 align-self-center border-end border-white px-4">
            <h5 class="text-uppercase fs-3"><?php pll_e('CONTÁCTANOS'); ?> <br> <?php pll_e('HOY MISMO') ?> </h5>
        </div>

        <div class="col-12 col-lg-5 px-4">
            <p class="fs-6 fw-light"><?php pll_e('Si estás interesado con comprar o rentar alguna de nuestras propiedades, te invitamos a hacer clic en el siguiente botón para que uno de nuestros asesores pueda brindarte atención especializada.') ?></p>
            <a href="<?= get_the_permalink(1802); ?>" class="btn btn-outline-light text-uppercase fw-light rounded-1"><?php pll_e('Mandar mensaje') ?></a>
        </div>

    </div>

</article>

<?php get_footer(); ?>