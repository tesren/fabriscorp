<?php 
    $regiones = get_terms( array(
        'taxonomy'          => 'regiones',
        'parent'            => 0,
        'hide_empty'        => false,
    ) );

    $propertiesType = get_terms( array(
        'taxonomy'          => 'property_type',
        'parent'            => 0,
        'hide_empty'        => false,
    ) ); 
?>

<div class="bg-white px-3 py-4 rounded-4 shadow-4">
    <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" class="row">
        <input type="hidden" placeholder="Search" value="<?php the_search_query() ?>" name="s" title="Search"/>

        <input type="hidden" value="propiedad-en-venta" name="post_type"/>

        <div class="col-12 col-lg-3 mb-3 mb-lg-0 border-end border-dark">
            <label for="type_s"><?php pll_e('Tipo de Propiedad');?></label>
            <select class="form-select w-100 rounded-1 py-2 bg-light" aria-label="Seleccione un tipo" id="type_s" name="type_s">
                <option selected value=""><?php pll_e('Todos los tipos');?></option>
                <?php foreach($propertiesType as &$type):?>
                    <option value="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-12 col-lg-7 border-end border-dark">
            <label for="regiones_s"><?php pll_e('Ubicación'); ?></label>
            <select class="form-select w-100 py-2 mb-3 bg-light" id="regiones_s" name="regiones_s">
                <option selected value=""><?php pll_e('Ubicación');?></option>

                <?php foreach($regiones as &$category):
                    $childrenTerms =  get_term_children( $category->term_id, 'regiones' );

                        foreach($childrenTerms as $child) :     
                            $term = get_term_by( 'id', $child, 'regiones');?>
                            <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                        <?php endforeach; ?>

                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-12 col-lg-2 align-self-center">
            <button type="submit" class="btn btn-blue w-100 py-2"><?php pll_e('Buscar');?></button>
        </div>

    </form>
</div>