<?php 
    
  $listings = get_posts(array(
    'post_type' => 'propiedad-en-venta',
    'numberposts' => -1,
    'meta_query' => array(
        array(
            'key' => 'avaliable',
            'value' => 'Vendido',
            'compare' => '!='
        ),
    ),
  ));
  

  $reviews = get_posts(array(
    'post_type' => 'review',
    'numberposts' => -1,
  ));

  get_header();
?>

<!-- Listings -->
<div class="container my-6">

  <div class="row">

    <?php foreach($listings as $listing): ?>

      <a href="<?= get_the_permalink($listing->ID) ?>" class="col-12 col-lg-4 position-relative mb-3 link-dark text-decoration-none">

        <?php $imgs = rwmb_meta('listing_gallery', ['size'=>'medium_large', 'limit'=>1], $listing->ID ); ?>
        <img src="<?= $imgs[0]['url'] ?>" alt="<?= get_the_title($listing->ID) ?>" class="w-100" style="height:280px; object-fit:cover;">

        <div class="position-absolute top-0 end-0 bg-yellow px-3 py-1 shadow-4 mt-2 me-4">
            <?php get_property_type($listing->ID, 'property_type') ?>
        </div>

        <div class="p-2">
            <h2 class="fs-5 text-uppercase fw-bold mb-1"><?= get_the_title($listing->ID) ?></h2>
            <p><?php get_list_terms($listing->ID, 'regiones') ?></p>
        </div>

      </a>

    <?php endforeach; ?>

  </div>

</div>

<!-- Servicios -->
<div class="container accordion mb-6" id="servicesAccordion">

  <div class="accordion-item">
    <h3 class="accordion-header">
      <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <?php pll_e('Compra y Venta de Inmuebles') ?>
      </button>
    </h3>
    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#servicesAccordion">
      <p class="accordion-body text-secondary">
        <?php pll_e('La representación de nuestros clientes al enlistar sus propiedades es una de nuestras mayores labores que disfrutamos hacer, con el fin de poder vender sus propiedades en el tiempo y forma que el cliente desea. De igual forma, nos encargamos en la búsqueda de propiedades con base en las necesidades que nuestros clientes deseen conseguir en el mercado.') ?>
      </p>
    </div>
  </div>

  <div class="accordion-item">
    <h3 class="accordion-header">
      <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        <?php pll_e('Coordinación de cierres') ?>
      </button>
    </h3>
    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#servicesAccordion">
      <p class="accordion-body text-secondary">
        <?php pll_e('Somos expertos en el manejo de los trámites legales y burocráticos ante las notarías públicas respectivas y otros organismos públicos, con el fin de poder lograr la transmisión de la propiedad en la compraventa de una propiedad en tiempo y forma.') ?>
      </p>
    </div>
  </div>

</div>

<!-- Testiomoniales -->
<div class="py-5 bg-light">

  <h4 class="text-center text-uppercase text-decoration-underline fs-2 letter-spacing-md mt-4 mb-5"><?php pll_e('Testimoniales') ?></h4>
  
  <section class="splide mb-5" aria-label="<?php pll_e('Testimoniales') ?>" id="testimonials">
    <div class="splide__track">
      <ul class="splide__list">

        <?php foreach($reviews as $review): ?>
          <li class="splide__slide rounded-0 shadow-4 my-3 me-2 p-4">

            <div class="text-center mb-5">
              <?php for($i=0; $i<5; $i++): ?>
                <i class="fa-solid text-yellow fs-3 fa-star"></i>
              <?php endfor;?>
            </div>

            <p class="fs-7">
              <?= $review->review_content ?>
            </p>

            <div class="text-end fw-bold fs-7">
              <?= $review->review_name ?> <br>
              <?= $review->review_position ?>
            </div>

          </li>
        <?php endforeach; ?>

      </ul>
    </div>
  </section>

</div>

<!-- Seccion de contacto -->
<div class="row justify-content-center py-5 text-white" style="background-image:url('<?= get_template_directory_uri().'/assets/images/bg-contact-section.webp' ?>');">

    <div class="col-12 col-lg-3 col-xxl-2 align-self-center border-end border-white px-4">
        <h5 class="text-uppercase"><?php pll_e('CONTÁCTANOS'); ?> <br> <?php pll_e('HOY MISMO') ?> </h5>
    </div>

    <div class="col-12 col-lg-5 px-4">
        <p class="fs-7"><?php pll_e('Si estás interesado con comprar o rentar alguna de nuestras propiedades, te invitamos a hacer clic en el siguiente botón para que uno de nuestros asesores pueda brindarte atención especializada.') ?></p>
        <a href="<?= get_the_permalink(pll_get_post(1802)); ?>" class="btn btn-outline-light text-uppercase fw-light rounded-1"><?php pll_e('Mandar mensaje') ?></a>
    </div>

</div>

<?php get_footer(); ?>