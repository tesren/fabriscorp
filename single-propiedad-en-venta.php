<?php get_header(); ?>

    <article>
  
        <?php if ( have_posts() ): ?>
                
            <?php while( have_posts() ): the_post();?>

                <?php $images = rwmb_meta('listing_gallery', ['size'=>'large', 'limit'=>40]);?>

                <div class="row mb-6">

                    <div class="col-12 px-0 position-relative">
                        <img src="<?= $images[0]['url'] ?>" alt="<?= $images[0]['title'] ?>" class="w-100 z-1" style="height:60vh; object-fit:cover;" data-fancybox="gallery">
                        <div class="fondo-oscuro z-2"></div>

                        <div class="position-absolute top-0 start-0 h-100 w-100 z-3 d-flex justify-content-center">
                            <div class="text-center text-white mb-1 align-self-center">
                                <h1 class="fs-0 fw-bold"><?= get_the_title(); ?></h1>
                                <h2 class="fs-4 fw-light"><?php get_list_terms(get_the_ID(), 'regiones'); ?></h2>
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-6 col-lg-3 p-1">
                        <img src="<?= $images[1]['url'] ?>" alt="<?= $images[1]['title'] ?>" class="w-100" style="height:27vh; object-fit:cover;" data-fancybox="gallery">
                    </div>
                    <div class="col-6 col-lg-3 p-1">
                        <img src="<?= $images[2]['url'] ?>" alt="<?= $images[2]['title'] ?>" class="w-100" style="height:27vh; object-fit:cover;" data-fancybox="gallery">
                    </div>
                    <div class="col-6 col-lg-3 p-1">
                        <img src="<?= $images[3]['url'] ?>" alt="<?= $images[3]['title'] ?>" class="w-100" style="height:27vh; object-fit:cover;" data-fancybox="gallery">
                    </div>
                    <div class="col-6 col-lg-3 p-1">
                        <a href="#gallery-5" class="w-100 d-flex justify-content-center position-relative text-decoration-none" style="height:27vh; background-image:url('<?= $images[4]['url'] ?>');background-size:cover;">
                            <div class="fondo-oscuro"></div>
                            <div class="align-self-center fs-1 text-white z-2">
                                <i class="fa-solid fa-images"></i>
                                <span><?= count($images) ?> +</span>
                            </div>
                        </a>
                    </div>

                    <?php for($i=4; $i<count($images); $i++): ?>
                        <img src="<?= $images[$i]['url'] ?>" alt="<?= $images[$i]['title'] ?>" class="d-none" data-fancybox="gallery">
                    <?php endfor; ?>

                </div>
                
                <div class="row justify-content-center position-relative">

                    <img width="250px" src="<?php echo get_template_directory_uri();?>/assets/icons/half-circle-gold.webp" alt="" class="position-absolute top-0 end-0 z-1" style="width:250px;transform: rotate(180deg);">

                    <!-- Detalles -->
                    <div class="col-12 col-lg-10">

                        <h2 class="text-center mb-5">
                            <div class="fw-light text-yellow mb-1"><?php get_property_type(get_the_ID(), 'property_type'); ?></div>
                            <div class="fs-0 fw-normal"><?= get_the_title(); ?></div>
                        </h2>

                        <div class="row justify-content-center">
                            <?php if(rwmb_meta('bedrooms')): ?>
                                <div class="col-6 col-lg-3 col-xxl-2 text-center mb-4 mb-lg-0">
                                    <div class="fs-1 blue-text fw-bold"><?= rwmb_meta('bedrooms'); ?></div>
                                    <div class="fs-5 fw-light text-uppercase"><?php pll_e('Recámaras');?></div>
                                </div>
                            <?php endif; ?>

                            <?php if(rwmb_meta('bathrooms')): ?>
                                <div class="col-6 col-lg-3 col-xxl-2 text-center mb-4 mb-lg-0">
                                    <div class="fs-1 blue-text fw-bold"><?= rwmb_meta('bathrooms'); ?></div>
                                    <div class="fs-5 fw-light text-uppercase"><?php pll_e('Baños');?></div>
                                </div>
                            <?php endif; ?>

                            <?php if(rwmb_meta('construction')): ?>
                                <div class="col-6 col-lg-3 col-xxl-2 text-center">
                                    <div class="fs-1 blue-text fw-bold"><?= rwmb_meta('construction'); ?>m²</div>
                                    <div class="fs-5 fw-light text-uppercase"><?php pll_e('Conts. Total');?></div>
                                </div>
                            <?php endif; ?>

                            <?php if(rwmb_meta('lot_area')): ?>
                                <div class="col-6 col-lg-3 col-xxl-2 text-center">
                                    <div class="fs-1 blue-text fw-bold"><?= rwmb_meta('lot_area'); ?>m²</div>
                                    <div class="fs-5 fw-light text-uppercase"><?php pll_e('Lote');?></div>
                                </div>
                            <?php endif; ?>

                            <!-- Estatus de la propiedad -->
                            <?php if( rwmb_meta('avaliable') == 'Disponible' ): ?>
                                <div class="col-12 text-center my-5">
                                    <div class="fs-5 text-success fw-bold"><?php pll_e(rwmb_meta('avaliable')) ?></div>
                                    <h2 class="fs-1 blue-text">$<?= number_format(rwmb_meta('price')); ?> <span class="fs-4"><?= rwmb_meta('currency');?></span></h2>
                                </div>
                            <?php elseif(rwmb_meta('avaliable') == 'Apartado'): ?>
                                <div class="col-12 text-center my-5">
                                    <div class="fs-5 text-warning fw-bold"><?php pll_e(rwmb_meta('avaliable')) ?></div>
                                    <h2 class="fs-1 blue-text">$<?= number_format(rwmb_meta('price')); ?> <span class="fs-4"><?= rwmb_meta('currency');?></span></h2>
                                </div>
                            <?php else: ?>
                                <div class="col-12 text-center my-5">
                                    <div class="fs-3 text-danger fw-bold"><?php pll_e(rwmb_meta('avaliable')) ?></div>
                                </div>
                            <?php endif; ?>

                        </div>

                    </div>

                    <hr class="col-11 col-lg-10 col-xxl-8">

                    <!-- Descripcion -->
                    <div class="col-12 col-lg-10 col-xxl-8 my-4">
                        <h3 class="fs-2 blue-text"><?php pll_e('Descripción');?></h3>
                        <div class="fs-6">
                            <?= rwmb_meta('description'); ?>
                        </div>

                        <?php $amenities = rwmb_meta('amenities');?>

                        <?php if($amenities): ?>
                            <h3 class="fs-2 blue-text mt-5"><?php pll_e('Amenidades');?></h3>
                            <div class="fs-5">
                                <?php 
                                    foreach($amenities as $key => $amenity):
                                        echo $amenity;
                                        if ($key == count($amenities) - 1) {
                                            echo ".";
                                        } else {
                                            echo ", ";
                                        }
                                    endforeach;
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <hr class="col-11 col-lg-10 col-xxl-8 mt-4">

                    <!-- Formulario de contacto -->
                    <div class="col-12 col-lg-10 col-xxl-8 mb-6 mt-5">
        
                        <div class="row justify-content-center py-5">

                            <div class="col-12 col-lg-4 col-xxl-3 border-end border-dark px-4 align-self-start">
                                <h5 class="text-uppercase fs-2"><?php pll_e('¡Envíanos'); ?> <br> <span class="fs-5 letter-spacing-md"><?php pll_e('un mensaje!') ?></span> </h5>
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
    </script>

<?php get_footer(); ?>