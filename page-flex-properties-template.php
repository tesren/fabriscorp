<?php
  /*
  Template Name: Flex Properties Template
  */

  
  if( isset($_GET['pagina']) ){
    $page = $_GET['pagina'];
  }else{
    $page = 1;
  }

  //busqueda
  if( isset($_GET['submit']) ){

    if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce']) ) {
      // nonce check failed
      die( 'Security check' );
    }
    else{

      $property_type = $_GET['tipo_propiedad'];
      $bedrooms = $_GET['recamaras'];
      $min_price = $_GET['min_price'];
      $max_price = $_GET['max_price'];

      $results = search_rets_listings($page, 15, $property_type, $bedrooms, $min_price, $max_price);
      $listings = $results['listings'];
      $pages = $results['total_pages'];
    
      shuffle($listings);
    }
  }
  //resultados normales
  else{
    $results = get_all_rets_listings($page);

    $listings = $results['listings'];
    $pages = $results['total_pages'];
  
    shuffle($listings);
  }

  get_header();
?>

<!-- Titulo -->
<section class="position-relative mb-6">

    <img src="<?= get_template_directory_uri().'/assets/images/contact-form-bg.webp' ?>" alt="Fabris Corp - Contacto" class="w-100" style="height:40vh; object-fit:cover;">

    <div class="row justify-content-center position-absolute top-0 start-0 h-100 text-white z-3">

        <div class="col-12 text-center align-self-center">
            <h1 class="text-uppercase fs-2"><?= get_the_title() ?></h1>
        </div>

    </div>

    <div class="fondo-oscuro"></div>

</section>


<!-- Formulario de búsqueda -->
<div class="row justify-content-center mb-5">

  <div class="col-12 col-lg-10 col-xxl-8">

    <form action="" method="get">

      <?php wp_nonce_field( -1, '_wpnonce', true, true); ?>

      <div class="input-group">
        
        <div class="form-floating">
          <input type="text" name="zona" id="zona" class="form-control" placeholder="Puerto Vallarta">
          <label for="zona" class="text-secondary"><i class="fa-solid text-yellow fa-bed"></i> <?php pll_e('Zona') ?></label>
        </div>

        <div class="form-floating">
          <select class="form-select" id="tipo_propiedad" aria-label="<?php pll_e('Tipo de propiedad') ?>" name="tipo_propiedad">
            <option selected value=""><?php pll_e('Todo') ?></option>
            <option value="A"><?php pll_e('Condominios') ?></option>
            <option value="B"><?php pll_e('Casas') ?></option>
            <option value="E"><?php pll_e('Lotes y Terrenos') ?></option>
            <option value="G"><?php pll_e('Negocios') ?></option>
            <option value="I"><?php pll_e('Multi Familiar') ?></option>
          </select>
          <label for="tipo_propiedad" class="text-secondary"><i class="fa-solid text-yellow fa-house-chimney"></i> <?php pll_e('Tipo de propiedad') ?></label>
        </div>

        <div class="form-floating">
          <input type="number" name="recamaras" id="recamaras" min="1" max="99" class="form-control" placeholder="1">
          <label for="recamaras" class="text-secondary"><i class="fa-solid text-yellow fa-bed"></i> <?php pll_e('Recámaras') ?></label>
        </div>

        <div class="form-floating">
          <select class="form-select" id="min_price" name="min_price" aria-label="Floating label select example">
            <option selected value="0">Seleccione</option>
            <?php
              for ($i = 1; $i <= 20; $i++) {
                $precio = $i * 100000;
                $price_label = '$'.number_format($precio);

                echo "<option value=\"$precio\">$price_label</option>";
              }
            ?>
          </select>
          <label for="min_price" class="text-secondary"><i class="fa-solid text-yellow fa-dollar-sign"></i> Precio Min.</label>
        </div>


        <div class="form-floating">
          <select class="form-select" id="max_price" name="max_price" aria-label="Floating label select example">
            <option selected value="9000000">Seleccione</option>
            <?php
              for ($i = 1; $i <= 20; $i++) {
                $precio = $i * 100000;
                $price_label = '$'.number_format($precio);

                echo "<option value=\"$precio\">$price_label</option>";
              }
            ?>
          </select>
          <label for="max_price" class="text-secondary"><i class="fa-solid text-yellow fa-dollar-sign"></i> Precio Max.</label>
        </div>

        <input class="btn btn-yellow" type="submit" name="submit" value="<?php pll_e('Search');?>">

      </div>

    </form>

  </div>

</div>


<!-- Listings -->
<section class="container row justify-content-center mb-6">


  <?php if($listings): ?>

    <?php foreach($listings as $listing): ?>
        <a href="#" class="col-12 col-lg-4 position-relative mb-3 link-dark text-decoration-none">

            <div class="shadow-4 rounded-4">
                
              <?php $img = get_portrait_url($listing['LIST_3']); ?>

              <picture>
                <source srcset="<?= $img ?>" type="image/jpeg">
                <img src="<?= get_template_directory_uri() ?>/assets/images/default-property-img.jpg" alt="<?= $listing['LIST_35'] ?>" onerror="this.onerror=null; this.src='<?= get_template_directory_uri() ?>/assets/images/default-property-img.jpg';" class="w-100 rounded-top-4" style="height:280px; object-fit:cover;" loading="lazy">
              </picture>

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

                $property_type = $listing['LIST_8'];
                switch ($property_type) {
                  case "A":
                    $property_type = 'Condos';
                    break;
                  case "B":
                    $property_type = 'Houses';
                    break;
                  case "E":
                    $property_type = "Land";
                    break;
                  case "F":
                    $property_type = "Commercial";
                    break;
                  case "G":
                    $property_type = "Business";
                    break;
                  case "H":
                    $property_type = "Fractional";
                    break;
                  case "I":
                    $property_type = "MultiFamily";
                    break;
                  default:
                  $property_type = "";
                }
              ?>

              <div class="position-absolute end-0 shadow-4 me-4 px-3 py-1 text-white rounded-pill <?= $status_classes ?>" style="top:235px;">
                <?= $listing['LIST_15'] ?>
              </div>

              <div class="p-3">
                <div class="fs-7 text-secondary fw-light"><?= $property_type ?></div>

                <h2 class="fs-5 text-uppercase fw-semi-bold mb-1 text-yellow">
                  <?= $listing['LIST_35'] ?>
                  <?php if( isset($listing['LIST_36']) ){ echo $listing['LIST_36']; } ?>
                </h2>

                <p class="fw-light mb-1">
                  <i class="fa-solid text-yellow fa-location-dot"></i><?= $listing['LIST_130'] ?>, <?= $listing['LIST_39'] ?>, <?= $listing['LIST_40'] ?>
                </p>

                <div class="d-flex fs-6 fw-light">

                  <?php if( isset($listing['LIST_66']) ): ?>
                    <div class="me-3">
                      <i class="fa-solid fa-bed"></i> <?= $listing['LIST_66'] ?>
                    </div>
                  <?php endif; ?>

                  <?php if( isset($listing['LIST_67']) ): ?>
                    <div class="me-3">
                      <i class="fa-solid fa-bath"></i> <?= $listing['LIST_67'] ?>
                    </div>
                  <?php endif; ?>

                  <?php if( isset($listing['LIST_126']) ): ?>
                    <div class="me-3">
                      <i class="fa-solid fa-house"></i> <?= $listing['LIST_126'] ?>m²
                    </div>
                  <?php endif; ?>

                  <?php if( isset($listing['LIST_119']) ): ?>
                    <div class="me-3">
                      <i class="fa-solid fa-maximize"></i> <?= $listing['LIST_119'] ?>m²
                    </div>
                  <?php endif; ?>

                </div>

              </div>

            </div>

        </a>
    <?php endforeach; ?>
  <?php endif; ?>


  <?php if(isset($pages)): ?>
    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination">
            
            <li class="page-item">
                <a class="page-link <?php echo ($page == 1) ? 'disabled' : ''; ?>" href="<?php echo esc_url(add_query_arg('pagina', $page - 1)); ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php
            // Calculamos el rango de páginas a mostrar
            $start_page = max(1, $page - 2);
            $end_page = min($start_page + 4, $pages);

            // Iteramos sobre las páginas a mostrar
            for ($i = $start_page; $i <= $end_page; $i++):
            ?>
                <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                    <a class="page-link" href="<?php echo esc_url(add_query_arg('pagina', $i)); ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>

            <li class="page-item">
                <a class="page-link" href="<?php echo esc_url(add_query_arg('pagina', $page + 1)); ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
  <?php endif; ?>


</section>


<?php get_footer(); ?>