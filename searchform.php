<?php
    if( isset( $_GET['recamaras'] ) ){
        $old_bedrooms = $_GET['recamaras'];
    }
    else{
        $old_bedrooms = '';
    }

    if( isset( $_GET['tipo_propiedad'] ) ){
        $property_type = $_GET['tipo_propiedad'];
    }
    else{
        $property_type = '';
    }

    $old_min_price = $_GET['min_price'] ?? 0;
    $old_max_price = $_GET['max_price'] ?? 0;

    
    $zones = get_all_zones();
    
?>

<div class="bg-white">
    <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" class="row">

        <input type="hidden" placeholder="Search" value="<?php the_search_query() ?>" name="s" title="Search"/>

        <input type="hidden" value="listing" name="post_type"/>

        <div class="row justify-content-center">
            
            <div class="col-12 col-lg-2 px-0 text-center mb-3 mb-lg-0">
                <label for="zona" class="text-secondary"><i class="fa-solid text-yellow fa-location-dot"></i> <?php pll_e('Zona') ?></label>
                <select name="zona" id="zona" class="align-self-end d-flex w-100" aria-label="Zona">
                    <option value=""><?php pll_e('Cualquier Zona') ?></option>
                    <?php foreach($zones as $zone): ?>
                        <option value="<?= $zone ?>"><?= $zone ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-12 col-lg-3 px-0 text-center mb-3 mb-lg-0">
                <label for="tipo_propiedad" class="text-secondary" style="margin-bottom:2px;"><i class="fa-solid text-yellow fa-house-chimney"></i> <?php pll_e('Tipo de propiedad') ?></label>
                <select class="form-select py-3 rounded-0" id="tipo_propiedad" aria-label="<?php pll_e('Tipo de propiedad') ?>" name="tipo_propiedad">

                    <option value=""><?php pll_e('Todo') ?></option>

                    <option <?php if($property_type=='A'){echo 'selected';} ?> value="A"><?php pll_e('Condominios') ?></option>
                    <option <?php if($property_type=='B'){echo 'selected';} ?> value="B"><?php pll_e('Casas y Villas') ?></option>
                    <option <?php if($property_type=='E'){echo 'selected';} ?> value="E"><?php pll_e('Lotes y Terrenos') ?></option>
                    <option <?php if($property_type=='F'){echo 'selected';} ?> value="F"><?php pll_e('Interés Común') ?></option>
                    <option <?php if($property_type=='G'){echo 'selected';} ?> value="G"><?php pll_e('Negocios') ?></option>
                    <option <?php if($property_type=='I'){echo 'selected';} ?> value="I"><?php pll_e('Multi Familiar') ?></option>

                </select>
            </div>

            <div class="col-12 col-lg-2 px-0 text-center mb-3 mb-lg-0">
                <label for="recamaras" class="text-secondary" style="margin-bottom:2px;"><i class="fa-solid text-yellow fa-bed"></i> <?php pll_e('Recámaras') ?></label>
                <input type="number" name="recamaras" id="recamaras" min="1" max="99" class="form-control py-3 rounded-0" placeholder="<?php pll_e('Recámaras') ?>" value="<?= $old_bedrooms ?>">
            </div>

            <div class="col-12 col-lg-2 px-0 text-center mb-3 mb-lg-0">
                <label for="min_price" class="text-secondary" style="margin-bottom:2px;"><i class="fa-solid text-yellow fa-dollar-sign"></i> <?php pll_e('Precio') ?> Min.</label>
                <select class="form-select py-3 rounded-0" id="min_price" name="min_price" aria-label="Floating label select example">
                    <option value="0" <?php echo $old_min_price == 0 ? 'selected' : ''; ?>><?php pll_e('Sin mínimo') ?></option>
                    <?php
                    for ($i = 1; $i <= 20; $i++) {
                        $precio = $i * 100000;
                        $price_label = '$'.number_format($precio);

                        echo "<option value=\"$precio\" ";
                        echo $old_min_price == $precio ? 'selected' : '';
                        echo ">$price_label</option>";
                    }
                    ?>
                </select>
            </div>


            <div class="col-12 col-lg-2 px-0 text-center mb-4 mb-lg-0">
                <label for="max_price" class="text-secondary" style="margin-bottom:2px;"><i class="fa-solid text-yellow fa-dollar-sign"></i> <?php pll_e('Precio') ?> Max.</label>
                <select class="form-select py-3 rounded-0" id="max_price" name="max_price" aria-label="Floating label select example">
                    <option value="90000000" <?php echo $old_max_price == 0 ? 'selected' : ''; ?>><?php pll_e('Sin Máximo') ?></option>
                    <?php
                    for ($i = 2; $i <= 30; $i++) {
                        $precio = $i * 100000;
                        $price_label = '$'.number_format($precio);

                        echo "<option value=\"$precio\" ";
                        echo $old_max_price == $precio ? 'selected' : '';
                        echo ">$price_label</option>";
                    }
                    ?>
                </select>
            </div>

            <input type="hidden" name="submit" value="Search">

            <button id="btn_submit" class="btn btn-yellow col-12 col-lg-1 align-self-end py-3" type="submit" style="margin-top:2px;">
                <i class="fa-solid fa-magnifying-glass"></i> <span class="d-inline d-lg-none"><?php pll_e('Buscar');?></span>
            </button>

        </div>

    </form>
</div>