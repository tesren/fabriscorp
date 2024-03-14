<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;500;700;900&display=swap" rel="stylesheet">

    <?php if(is_front_page()): ?>
        <title>Fabris Corp - <?php pll_e('Propiedades en Nuevo Vallarta y Riviera Nayarit');?></title>
        <meta name="description" content="<?php pll_e('Propiedades de lujo en venta que se encuentran diferentes partes de la República Mexicana, tales como Nuevo Vallarta y Riviera Nayarit.');?>">
    <?php elseif(is_post_type_archive()):?>
        <title>Fabris Corp - <?php echo post_type_archive_title(); ?></title>
        <meta name="description" content="<?php pll_e('Propiedades de lujo en venta que se encuentran diferentes partes de la República Mexicana, tales como Nuevo Vallarta y Riviera Nayarit.');?>">
    <?php elseif( is_page() ):?>
        <title>Fabris Corp - <?php echo single_post_title(); ?></title>
        <meta name="description" content="<?php echo get_the_excerpt(); ?>">
    <?php else: ?>
        <title>Fabris Corp - <?php echo the_title(); ?></title>
        <meta name="description" content="<?php echo get_the_excerpt(); ?>">
	  <?php endif; ?>

    <!-- CSS -->
    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/assets/css/bootstrap.min.css" as="style">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/bootstrap.min.css">

    <?php if( !is_front_page() ): ?>
      <link rel="preload" href="<?php echo get_template_directory_uri() ?>/assets/css/fancybox.min.css" as="style">
      <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/fancybox.min.css">
    <?php endif ;?>

    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/assets/css/splide.min.css" as="style">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets/css/splide.min.css">

    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/assets/css/all.min.css" as="style">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets/css/all.min.css">

    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/assets/css/nice-select2.css" as="style">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets/css/nice-select2.css">

    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/assets/css/fabris-styles-v1.css" as="style">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/fabris-styles-v1.css">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >

<nav class="navbar navbar-expand-xl bg-black navbar-dark sticky-top py-1">
  <div class="container-fluid">

    <a class="navbar-brand" href="<?= get_home_url();?>">
        <img width="160px" src="<?php echo get_template_directory_uri();?>/assets/images/logo-fabriscorp.webp" alt="Logo de Fabris Corp">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

      <div class="offcanvas-header bg-black">
        <div class="offcanvas-title" id="offcanvasNavbarLabel">
            <img class="w-75 px-4" src="<?php echo get_template_directory_uri();?>/assets/images/logo-fabriscorp.webp" alt="Logo de Fabris Corp">
        </div>

        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>

      <div class="offcanvas-body pe-4 bg-black text-white">
        <?php
          wp_nav_menu( array(
            'theme_location'    => 'primary',
            'depth'             => 2,
            'container'         => 'ul',
            //'container_class'   => ' list-unstyled',
            'container_id'      => 'navbarSupportedContent',
            'menu_class'        => 'navbar-nav justify-content-end flex-grow-1 pe-3 fw-bold',
            //'menu_id'           => '',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker(),
          ) );
        ?>

        <div class="col-12 col-lg-2 col-xxl-1 fs-5 text-center align-self-center">
          <a href="https://www.instagram.com/fabriscorp.realty/" target="_blank" class="link-light text-decoration-none" rel="noopener noreferrer" title="Seguir en Instagram">
            <i class="fa-brands fa-instagram"></i>
          </a>

          <a href="https://www.facebook.com/people/Fabris-Corp/100088100049695/?mibextid=LQQJ4d" target="_blank" class="link-light text-decoration-none mx-3" rel="noopener noreferrer" title="Seguir en Facebook">
            <i class="fa-brands fa-facebook-f"></i>
          </a>

          <a href="https://www.tiktok.com/@fabris.corp" target="_blank" class="link-light text-decoration-none" rel="noopener noreferrer" title="Seguir en TikTok">
            <i class="fa-brands fa-tiktok"></i>
          </a>
        </div>

      </div>

    </div>

  </div>
</nav>