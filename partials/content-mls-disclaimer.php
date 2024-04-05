<div class="container text-dark my-4">

    <div class="fw-light mb-3"><?php pll_e('Los precios publicados en dólares deberán ser pagados en pesos mexicanos, de acuerdo con el tipo de cambio establecido en el Diario Oficial de la Federación en la fecha en que se realicen los pagos por la compraventa.') ?></div>

    <div class="d-flex">
        <img src="<?php echo get_template_directory_uri()?>/assets/images/mls-vallarta-nayarit.jpg" alt="MLS Vallarta Nayarit">
        <div class="fw-light ms-2">
            <?php $today = date('d-M-Y'); ?>
            <?php 
                pll_e('Toda la información se considera confiable, pero no garantizada. Los listados en este sitio se muestran por cortesía del programa IDX de AMPI Vallarta Nayarit MLS y pueden no ser listados del propietario del sitio. Datos actualizados por última vez: ');
                echo $today.', 4:00:00';
            ?>
        </div>
    </div>
</div>