<?php
    /*
    Template Name: Flex Properties Template
    */

    $listings = get_rets_listings();

    get_header();
?>

<section class="position-relative mb-6">

    <img src="<?= get_template_directory_uri().'/assets/images/contact-form-bg.webp' ?>" alt="Fabris Corp - Contacto" class="w-100" style="height:40vh; object-fit:cover;">

    <div class="row justify-content-center position-absolute top-0 start-0 h-100 text-white z-3">

        <div class="col-12 text-center align-self-center">
            <h1 class="text-uppercase fs-2"><?= get_the_title() ?></h1>
        </div>

    </div>

    <div class="fondo-oscuro"></div>

</section>

<section class="row justify-content-center mb-6">

    <?php foreach($listings as $listing): ?>
        <a href="#" class="col-12 col-lg-4 position-relative mb-3 link-dark text-decoration-none">

            <div class="shadow-4 rounded-4">
                
              <!-- ?php $imgs = rwmb_meta('listing_gallery', ['size'=>'medium_large', 'limit'=>1], $listing->ID ); ?> -->

              <img src="..." alt="<?= $listing['LIST_35'] ?>" class="w-100 rounded-top-4" style="height:280px; object-fit:cover;" >

              <div class="position-absolute top-0 start-0 shadow-4 mt-2 ms-4">
                <div class="position-relative">

                  <div class="position-relative z-3 bg-white rounded-pill px-3 py-1">$<?= number_format($listing['LIST_22']) ?></div>

                  <div class="position-absolute rounded-pill bg-yellow py-1 ps-5 pe-3 z-2 top-0" style="right:-60px;">
                    USD
                  </div>

                </div>
              </div>

              <?php
                if($listing['LIST_15'] == 'Active'){
                  $status_classes = 'bg-success';
                }elseif( $listing['LIST_15'] == 'Pending' ){
                  $status_classes = 'bg-warning';
                }else{
                  $status_classes = 'bg-danger';
                }
              ?>

              <div class="position-absolute end-0 shadow-4 me-4 px-3 py-1 text-white rounded-pill <?= $status_classes ?>" style="top:235px;">
                <?= $listing['LIST_15'] ?>
              </div>

              <div class="p-3">
                <div class="fs-7 text-secondary fw-light"><?php get_property_type($listing->ID, 'property_type') ?></div>
                <h2 class="fs-5 text-uppercase fw-bold mb-1 text-yellow"><?= $listing['LIST_35'] ?></h2>
                <p class="fw-light mb-1"><i class="fa-solid text-yellow fa-location-dot"></i> <?= $listing['LIST_39'] ?>, <?= $listing['LIST_40'] ?></p>

                <div class="d-flex fs-6 fw-light">

                  <?php if( isset($listing->bedrooms) ): ?>
                    <div class="me-3">
                      <i class="fa-solid fa-bed"></i> <?= $listing->bedrooms ?>
                    </div>
                  <?php endif; ?>

                  <?php if( isset($listing->bathrooms) ): ?>
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

</section>


<?php get_footer(); ?>