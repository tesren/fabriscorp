<?php
 /*
  Template Name: Contact Template
 */
get_header();
?>

<section class="position-relative mb-6">

    <img src="<?= get_template_directory_uri().'/assets/images/house-background.webp' ?>" alt="Fabris Corp - Contacto" class="w-100" style="height:40vh; object-fit:cover;">

    <div class="row justify-content-center position-absolute top-0 start-0 h-100 text-white z-3">

        <div class="col-12 col-lg-4 col-xxl-3 border-end border-light px-4 align-self-end align-self-lg-center">
            <h1 class="text-uppercase fs-2 text-center text-lg-end"><?php pll_e('Contáctanos'); ?> <br> <span class="fs-5 letter-spacing-md"><?php pll_e('hoy mismo') ?></span> </h1>
        </div>

        <div class="col-12 col-lg-6 px-4 align-self-start align-self-lg-center">
            <p class="fs-5 fw-light text-center text-lg-start"><?php pll_e('Si estás interesado con comprar o rentar alguna de nuestras propiedades, te invitamos a hacer clic en el siguiente botón para que uno de nuestros asesores pueda brindarte atención especializada.') ?></p>
        </div>

    </div>

    <div class="fondo-oscuro"></div>

</section>

<section class="row justify-content-center mb-6">

    <div class="col-12 col-lg-4 d-none d-lg-block align-self-center">

        <img src="<?= get_template_directory_uri() ?>/assets/images/pool-ocean-view.webp" alt="Fabris Corp - Contacto" class="w-100">

    </div>

    <!-- Formulario de contacto -->
    <div class="col-12 col-lg-6 align-self-center">
        
        <h2 class="text-center text-lg-start mb-4 fs-5 px-3"><?php pll_e('Llene el formulario y nos comunicaremos con usted lo más pronto posible') ?></h2>

        <?php 
            $lang = pll_current_language();
            
            if( $lang == 'es'){
                echo do_shortcode( '[cf7form cf7key="formulario-de-contacto-1"]' );
            }
            else{
                echo do_shortcode( '[cf7form cf7key="formulario-de-contacto-ingles"]' );
            }
        ?>

    </div>

</section>


<?php get_footer(); ?>