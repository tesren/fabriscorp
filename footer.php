<footer class="bg-black text-white pt-4 pt-lg-5" style="background-image:url('<?= get_template_directory_uri().'/assets/images/footer-bg.webp'; ?>');">

    <div class="row justify-content-center px-2 mb-5">

        <div class="col-12 col-lg-2 mb-5 mb-lg-0">
            <div class="text-center text-lg-start">
                <img src="<?php echo get_template_directory_uri()?>/assets/images/logo-fabriscorp.webp" alt="Logo de HeyHaus" class="col-6 col-lg-9 mx-auto mb-4">
            </div>
            <p class="fs-7"><?php pll_e('Fabris Corp es una empresa inmobiliaria experta en Bienes Raíces en todo México.') ?></p>

            <a href="mailto:edgarfabris@fabriscorp.com" class="link-light text-decoration-none mb-3 d-block">edgarfabris@fabriscorp.com</a>
            <a href="tel:+523222897847" class="link-light text-decoration-none">+52 322 289 7847</a>
        </div>

        <div class="col-12 col-lg-3 mb-5 mb-lg-0 mt-0 mt-lg-5">
            <h6 class="fs-5 mb-4"><?php pll_e('Enlaces adicionales')?></h6>

            <ul class="fs-7">
                <li class="mb-2">
                    <a href="<?= get_the_permalink( get_page_by_title( 'AVISO DE PRIVACIDAD') ) ?>" class="link-light text-decoration-none" target="_blank" rel="noopener noreferrer">
                        <?php pll_e('Aviso de Privacidad')?>
                    </a>
                </li>

                <li class="mb-2">
                    <a href="<?= get_template_directory_uri().'/assets/pdf/Carta-de-Derechos-FC.docx.pdf' ?>" class="link-light text-decoration-none" target="_blank" rel="noopener noreferrer">
                        <?php pll_e('Carta de Derechos del Consumidor')?>
                    </a>
                </li>

                <li class="mb-2">
                    <a href="<?= get_template_directory_uri().'/assets/pdf/Politica-de-No-Discriminacion-FC.pdf' ?>" class="link-light text-decoration-none" target="_blank" rel="noopener noreferrer">
                        <?php pll_e('Política de No Discriminación')?>
                    </a>
                </li>

                <li class="mb-2">
                    <a href="<?= get_template_directory_uri().'/assets/pdf/Contrato-de-Adhesion-Profeco.pdf' ?>" class="link-light text-decoration-none" target="_blank" rel="noopener noreferrer">
                        <?php pll_e('Contrato de Adhesión PROFECO')?>
                    </a>
                </li>
            </ul>

        </div>

        <div class="col-12 col-lg-4">
            <?php 
                $lang = 'es';
                if( $lang == 'es'){
                    echo do_shortcode( '[cf7form cf7key="formulario-footer"]' );
                }
                else{
                    echo do_shortcode( '[cf7form cf7key="formulario-footer-ingles"]' );
                }
            ?>
        </div>

    </div>


    <div class="py-3 row justify-content-evenly bg-dark">
        <div class="col-12 col-lg-5 fw-light align-self-center fs-7 text-center text-lg-start mb-3 mb-lg-0">
            Fabriscorp Grupo Inmobiliario y de Negocios S. de R.L. de C.V. | Copyright <?php echo date('Y');?>©
        </div>
        <div class="col-12 col-lg-2 fs-5 text-center">
            <a href="https://www.instagram.com/fabriscorp.realty/" target="_blank" class="link-light text-decoration-none" rel="noopener noreferrer" title="<?php pll_e('Seguir en')?> Instagram">
                <i class="fa-brands fa-instagram"></i>
            </a>

            <a href="https://www.facebook.com/people/Fabris-Corp/100088100049695/?mibextid=LQQJ4d" target="_blank" class="link-light text-decoration-none mx-3" rel="noopener noreferrer" title="<?php pll_e('Seguir en')?> Facebook">
                <i class="fa-brands fa-facebook-f"></i>
            </a>

            <a href="https://www.tiktok.com/@fabris.corp" target="_blank" class="link-light text-decoration-none" rel="noopener noreferrer" title="<?php pll_e('Seguir en')?> TikTok">
                <i class="fa-brands fa-tiktok"></i>
            </a>
        </div>
    </div>


</footer>

<!-- Boton de whatsapp -->
<a href="https://wa.me/523222897847?text=<?php pll_e('Hola, vengo del sitio web de Fabris Corp') ?>" id="whatsapp" target="_blank" rel="noopener noreferrer" data-bs-toggle="tooltip" data-bs-title="<?php pll_e('Contactar por WhatsApp') ?>" aria-label="Whatsapp contact" class="shadow-4"> 
    <i class="fa-brands fa-whatsapp"></i>
</a>

<script src="<?php echo get_template_directory_uri()?>/assets/js/bootstrap.bundle.min.js" defer></script>

<?php if( !is_front_page() ): ?>
    <script src="<?php echo get_template_directory_uri()?>/assets/js/fancybox.umd.js" defer></script>
<?php endif; ?>

<script src="<?php echo get_template_directory_uri()?>/assets/js/splide.min.js" defer></script>

<!-- <script src="<?php echo get_template_directory_uri()?>/assets/js/range-slider.js" defer></script>
 -->
<script src="<?php echo get_template_directory_uri()?>/assets/js/nice-select2.min.js" defer></script>

<script src="<?php echo get_template_directory_uri()?>/assets/js/fabris.js" defer></script>

<?php wp_footer(); ?>
</body>
</html>             