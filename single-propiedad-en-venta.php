<?php get_header(); ?>

    <article>
  
        <?php if ( have_posts() ): ?>
                
            <?php while( have_posts() ): the_post();?>

                <?php $images = rwmb_meta('listing_gallery', ['size'=>'large', 'limit'=>40]);?>

                <div class="row mb-6">

                    <div class="col-12 px-0 position-relative">
                        <img src="<?= $images[0]['url'] ?>" alt="<?= $images[0]['title'] ?>" class="w-100 z-1" style="height:37vh; object-fit:cover;" data-fancybox="gallery">
                        <div class="fondo-oscuro z-2"></div>

                        <div class="position-absolute top-0 start-0 h-100 w-100 z-3 d-flex justify-content-center">
                            <div class="text-center text-white mb-1 align-self-center">
                                <h1 class="fs-2 fw-bold"><?= get_the_title(); ?></h1>
                                <h2 class="fs-5 fw-light mb-4"><?php get_list_terms(get_the_ID(), 'regiones'); ?></h2>
                                <a href="#gallery-1" class="btn btn-outline-light rounded-0"><?php pll_e('Ver Galería') ?></a>
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-6 col-lg-4 p-0 d-none d-lg-block">
                        <img src="<?= $images[1]['url'] ?>" alt="<?= $images[1]['title'] ?>" class="w-100" style="height:50vh; object-fit:cover;" data-fancybox="gallery">
                    </div>

                    <div class="col-6 col-lg-4 p-0 d-none d-lg-block">
                        <img src="<?= $images[2]['url'] ?>" alt="<?= $images[2]['title'] ?>" class="w-100" style="height:50vh; object-fit:cover;" data-fancybox="gallery">
                    </div>

                    <div class="col-6 col-lg-4 p-0 d-none d-lg-block">
                        <img src="<?= $images[3]['url'] ?>" alt="<?= $images[3]['title'] ?>" class="w-100" style="height:50vh; object-fit:cover;" data-fancybox="gallery">
                    </div>



                    <?php for($i=4; $i<count($images); $i++): ?>
                        <img src="<?= $images[$i]['url'] ?>" alt="<?= $images[$i]['title'] ?>" class="d-none" data-fancybox="gallery">
                    <?php endfor; ?>

                </div>

                <div class="container row justify-content-center">

                    <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                        <h2>
                            <div class="text-yellow fs-5 text-uppercase"><?php pll_e(get_property_type(get_the_ID(), 'property_type')) ?></div>
                            <div class="fs-2 fw-bold"><?= get_the_title(); ?></div>
                            <div class="fw-light fs-5"><?php get_list_terms(get_the_ID(), 'regiones'); ?></div>
                        </h2>
                    </div>

                    <!-- Detalles -->
                    <div class="col-12 col-lg-5 mb-4">
                        <div class="d-flex justify-content-evenly">

                            <?php if(rwmb_meta('bedrooms')): ?>
                                <div class="text-center me-2">
                                    <div class="fw-normal fs-3"><?= rwmb_meta('bedrooms'); ?> <i class="fa-solid text-yellow fa-bed"></i></div>
                                    <div class="text-secondary"><?php pll_e('Recámaras');?></div>
                                </div>
                            <?php endif; ?>

                            <?php if(rwmb_meta('bathrooms')): ?>
                                <div class="text-center me-2">
                                    <div class="fw-normal fs-3"><?= rwmb_meta('bathrooms'); ?> <i class="fa-solid text-yellow fa-bath"></i></div>
                                    <div class="text-secondary"><?php pll_e('Baños');?></div>
                                </div>
                            <?php endif; ?>

                            <?php if(rwmb_meta('construction')): ?>
                                <div class="text-center me-2">
                                    <div class="fw-normal fs-3"><?= rwmb_meta('construction'); ?>m² <i class="fa-solid text-yellow fa-house"></i></div>
                                    <div class="text-secondary"><?php pll_e('Conts. Total');?></div>
                                </div>
                            <?php endif; ?>

                            <?php if(rwmb_meta('lot_area')): ?>
                                <div class="text-center me-2">
                                    <div class="fw-normal fs-3"><?= rwmb_meta('lot_area'); ?>m² <i class="fa-solid text-yellow fa-maximize"></i></div>
                                    <div class="text-secondary"><?php pll_e('Lote');?></div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                    <!-- Estatus de la propiedad -->
                    <div class="col-12 col-lg-3">
                        <?php if( rwmb_meta('avaliable') == 'Disponible' ): ?>

                            <div class="text-center text-lg-start">
                                <div class="fs-5 text-success fw-light text-uppercase"><?php pll_e(rwmb_meta('avaliable')) ?></div>

                                <h2 class="fs-3 blue-text fw-bold mb-0">
                                    <span id="price_mxn">$<?= number_format(rwmb_meta('price')); ?> MXN</span>

                                    <?php if( rwmb_meta('price_usd') ): ?>
                                        <span id="price_usd" class="d-none">$<?= number_format(rwmb_meta('price_usd')); ?> USD</span>
                                        <img onclick="changeCurrency()" data-bs-toggle="tooltip" data-bs-title="Cambiar Moneda" width="20px" src="<?= get_template_directory_uri()?>/assets/images/change-currency.webp" alt="Change Currency">
                                    <?php endif; ?>
                                </h2>

                                
                            </div>

                        <?php elseif(rwmb_meta('avaliable') == 'Apartado'): ?>

                            <div class="text-center text-lg-start">
                                <div class="fs-5 text-warning fw-light text-uppercase"><?php pll_e(rwmb_meta('avaliable')) ?></div>
                                <h2 class="fs-1 blue-text">$<?= number_format(rwmb_meta('price')); ?> <span class="fs-4"><?= rwmb_meta('currency');?></span></h2>
                            </div>

                        <?php else: ?>

                            <div class="text-center text-lg-start">
                                <div class="fs-3 text-danger fw-light text-uppercase"><?php pll_e(rwmb_meta('avaliable')) ?></div>
                            </div>

                        <?php endif; ?>
                    </div>

                    <!-- Descripcion -->
                    <div class="col-12 my-5">

                        <h3 class="fs-4 text-yellow text-uppercase fw-normal"><?php pll_e('Descripción');?></h3>
                        <hr class="col-12 col-lg-3 mt-0">

                        <div class="fs-6 fw-light mb-5">
                            <?= rwmb_meta('description'); ?>
                        </div>

                        <?php $amenities = rwmb_meta('amenities');?>

                        <!-- Amenidades -->
                        <?php if($amenities): ?>
                            <h3 class="fs-4 text-yellow text-uppercase fw-normal"><?php pll_e('Amenidades');?></h3>
                            <hr class="col-12 col-lg-3 mt-0">
                            <ul class="fs-6 fw-light">
                                <?php foreach($amenities as $key => $amenity):?>
                                    <li><?= $amenity ?></li>
                                <?php endforeach;?>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <!-- Ubicación -->
                    <div class="col-12 mb-6">
                        <h4 class="fs-4 text-yellow text-uppercase fw-normal">Ubicación</h4>
                        <hr class="col-12 col-lg-3 mt-0">
                        <div>
                            <?php
                                $args = [
                                    'width'        => '100%',
                                    'height'       => '480px',
                                    'zoom'         => 14,
                                    'marker'       => true,
                                ];
                                rwmb_the_value( 'map', $args );
                            ?>
                        </div>
                    </div>

                </div>
                
                <div class="row justify-content-center position-relative">

                    <!-- Seccion de contacto -->
                    <div class="col-12 col-lg-10 col-xxl-9 my-5 z-2 position-relative">
        
                        <div class="row justify-content-center py-5 text-white">

                            <div class="col-12 col-lg-4 col-xxl-3 border-end border-white px-4 align-self-start">
                                <h5 class="text-uppercase fs-2"><?php pll_e('¡Envíanos'); ?> <br> <span class="fs-5 letter-spacing-md"><?php pll_e('un mensaje!') ?></span> </h5>
                            </div>

                            <div class="col-12 col-lg-7 px-4 align-self-center">
                                <p class="fs-6 fw-light"><?php pll_e('Si estás interesado con comprar o rentar alguna de nuestras propiedades, te invitamos a hacer clic en el siguiente botón para que uno de nuestros asesores pueda brindarte atención especializada.') ?></p>
                                <a href="<?= get_the_permalink(22); ?>" class="btn btn-outline-light text-uppercase fw-light rounded-0"><?php pll_e('Mandar mensaje') ?></a>
                            </div>

                        </div>

                    </div>

                    <img src="<?= get_template_directory_uri().'/assets/images/contact-form-bg.webp' ?>" alt="Fabris Corp Properties" class="z-1 px-0 w-100 h-100 position-absolute top-0 start-0" style="object-fit:cover;">

                    <div class="fondo-oscuro"></div>

                </div>

            <?php endwhile; ?>
            
        <?php endif; ?>

    </article>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Fancybox.bind("[data-fancybox]", {
                // Your custom options
            });
        });

        function changeCurrency(){

            var priceMXN = document.getElementById('price_mxn');
            var priceUSD = document.getElementById('price_usd');

            priceMXN.classList.toggle('d-none');
            priceUSD.classList.toggle('d-none');

        }
    </script>

<?php get_footer(); ?>