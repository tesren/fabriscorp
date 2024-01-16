<?php
 /*
  Template Name: Contact Template
 */
get_header();
?>

<section class="py-5" style="background-image:url('<?= get_template_directory_uri().'/assets/images/contact-bg.jpg' ?>'); background-position:center;">
    <h1 class="text-center text-white my-5 fs-0"><?php pll_e('CONTÁCTANOS') ?></h1>
</section>

<section class="row justify-content-center">

    <!-- Formulario de contacto -->
    <div class="col-12 col-lg-10 mb-6 mt-5">
        
        <div class="row justify-content-center py-5">

            <div class="col-12 col-lg-4 col-xxl-3 border-end border-dark px-4 align-self-start">
                <h2 class="text-uppercase fs-2"><?php pll_e('¡Envíanos'); ?> <br> <span class="fs-5 letter-spacing-md"><?php pll_e('un mensaje!') ?></span> </h2>
            </div>

            <div class="col-12 col-lg-7 px-4 align-self-center">
                <p class="fs-6"><?php pll_e('Si estás interesado con comprar o rentar alguna de nuestras propiedades, te invitamos a hacer clic en el siguiente botón para que uno de nuestros asesores pueda brindarte atención especializada.') ?></p>
                <a href="<?= get_the_permalink(pll_get_post(22)); ?>" class="btn btn-outline-light text-uppercase fw-light rounded-1"><?php pll_e('Mandar mensaje') ?></a>
            </div>

        </div>
        <?php 
            if( pll_current_language() == 'es'){
                echo do_shortcode( '[cf7form cf7key="formulario-de-contacto-1"]' );
            }
            else{
                echo do_shortcode( '[cf7form cf7key="formulario-de-contacto-ingles"]' );
            }
        ?>
    </div>

</section>


<?php get_footer(); ?>