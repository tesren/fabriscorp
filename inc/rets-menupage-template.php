
<?php
    if( isset( $_POST['submit'] ) ){

        if( isset($_POST['limit']) ){
            $limit = $_POST['limit'];
        }else{
            $limit = 99999;
        }

        if(isset($_POST['type'])) {
            // Si hay valores seleccionados
            foreach($_POST['type'] as $selected) {
                $types[] = $selected;
            }
        }else{
            $types = [];
        }

        $listings = update_listings($types, $limit);

        foreach($listings as $listing){
            
            $author_id = get_current_user_id() ?: 1;

            if( isset($listing['LIST_35']) and !empty($listing['LIST_35']) ){

                // Verificar si el post ya existe por su título
                $post_id = post_exists($listing['LIST_35']);

                if ($post_id) {
                    // Si el post existe, actualiza sus metadatos
                    $listing_post = array(
                        'ID'           => $post_id,
                        'post_content' => $listing['LIST_78'],
                        'meta_input'   => array(
                            'mls_id'        => $listing['LIST_1'],
                            'price'         => $listing['LIST_240'],
                            'price_usd'     => $listing['LIST_22'],
                            'property_type' => $listing['LIST_8'],
                            'avaliable'     => $listing['LIST_15'],
                            'bedrooms'      => $listing['LIST_66'] ?? '0',
                            'bathrooms'     => $listing['LIST_67'] ?? '0',
                            'construction'  => $listing['LIST_159'] ?? $listing['LIST_126'] ?? '0',
                            'lot_area'      => $listing['LIST_119'] ?? $listing['LIST_126'] ?? '0',
                            'state'         => $listing['LIST_40'],
                            'city'          => $listing['LIST_39'],
                            'community'     => $listing['LIST_130'],
                            'map'           => $listing['LIST_46'] . ',' . $listing['LIST_47'] . ',14',
                            'amenities'     => $listing['GF20101117190905087047000000'] ?? '0',
                            'directions'    => $listing['LIST_82'],
                        )
                    );

                    wp_update_post($listing_post);
                } else {
                    // Si el post no existe, créalo
                    $listing_post = array(
                        'post_type'    => 'listings',
                        'post_title'   => $listing['LIST_35'],
                        'post_status'  => 'publish',
                        'post_content' => $listing['LIST_78'],
                        'post_author'  => $author_id,
					    'lang' => 'es',
                        'meta_input'   => array(
                            'mls_id'        => $listing['LIST_1'],
                            'price'         => $listing['LIST_240'],
                            'price_usd'     => $listing['LIST_22'],
                            'property_type' => $listing['LIST_8'],
                            'avaliable'     => $listing['LIST_15'],
                            'bedrooms'      => $listing['LIST_66'] ?? '0',
                            'bathrooms'     => $listing['LIST_67'] ?? '0',
                            'construction'  => $listing['LIST_159'] ?? $listing['LIST_126'] ?? '0',
                            'lot_area'      => $listing['LIST_119'] ?? $listing['LIST_126'] ?? '0',
                            'state'         => $listing['LIST_40'],
                            'city'          => $listing['LIST_39'],
                            'community'     => $listing['LIST_130'],
                            'map'           => $listing['LIST_46'] . ',' . $listing['LIST_47'] . ',14',
                            'amenities'     => $listing['GF20101117190905087047000000'] ?? '0',
                            'directions'    => $listing['LIST_82'],
                        )
                    );

                    wp_insert_post($listing_post);
                }
            }

        }

    }

    //no hace nada alv
    if( isset( $_POST['translate_listings'] ) ){

        $listings = get_posts([
            'post_type' => 'listings',
            'numberposts' => -1,
            'lang' => 'es'
        ]);
    

        foreach($listings as $listing){
    
            $listing_en = pll_get_post($listing->ID, 'en'); // Obtener la traducción en inglés
    
            if( $listing_en == null ){
    
                $author_id = get_current_user_id() ?: 1;
    
                // Obtener el título y contenido del post en español
                $post_title = $listing->post_title;
                $post_content = $listing->post_content;
    
                // Si el post no existe en inglés, créalo
                $listing_post = array(
                    'post_type'    => 'listings',
                    'post_title'   => $post_title,
                    'post_status'  => 'publish',
                    'post_content' => $post_content,
                    'post_author'  => $author_id,
                    'lang'         => 'en',
                    'meta_input'   => array(
                        'mls_id'        => $listing->mls_id,
                        'price'         => $listing->price,
                        'price_usd'     => $listing->price_usd,
                        'property_type' => $listing->property_type,
                        'avaliable'     => $listing->avaliable,
                        'bedrooms'      => $listing->bedrooms ?? '0',
                        'bathrooms'     => $listing->bathrooms ?? '0',
                        'construction'  => $listing->construction ?? '0',
                        'lot_area'      => $listing->lot_area ?? '0',
                        'state'         => $listing->state,
                        'city'          => $listing->city,
                        'community'     => $listing->community,
                        'map'           => $listing->map,
                        'amenities'     => $listing->amenities,
                        'directions'    => $listing->directions,
                    )
                );
    
                $new_post = wp_insert_post($listing_post); // Insertar el nuevo post en inglés

                pll_set_post_language($new_post, 'en');
    
                if ($new_post) {
                    // Guardar la relación de traducción entre los posts
                    pll_save_post_translations([
                        'es' => $listing->ID,
                        'en' => $new_post,
                    ]);
                }
    
            }
    
        }
    
    }
    
?>

<h1 class="fs-4 mt-3 fw-normal mb-4">Propiedades Flex MLS</h1>

<div id="anchor"></div>


<div class="row w-100 mx-auto" >
    
    <div class="col-12 col-lg-6 col-xxl-4 bg-white p-4 border border-1 rounded-3">
        <h2 class="fs-5">Actualizar propiedades de Flex Manualmente</h2>
        <p class="fs-6 text-secondary">Desde este formulario puedes actualizar la información y la cantidad de listings de MLS que hay en sitio web de forma manual.</p>

        <form action="" method="post">

            <div class="form-check d-flex">
                <input class="form-check-input align-self-center" type="checkbox" value="A" name="type[]" id="condos" checked>
                <label class="form-check-label" for="condos">
                    Condominios
                </label>
            </div>
            
            <div class="form-check d-flex">
                <input class="form-check-input align-self-center" type="checkbox" value="B" name="type[]" id="houses">
                <label class="form-check-label" for="houses">
                    Casas y Villas
                </label>
            </div>

            <div class="form-check d-flex">
                <input class="form-check-input align-self-center" type="checkbox" value="E" name="type[]" id="lotes">
                <label class="form-check-label" for="lotes">
                    Lotes y Terrenos
                </label>
            </div>

            <div class="form-check d-flex">
                <input class="form-check-input align-self-center" type="checkbox" value="F" name="type[]" id="common_interest">
                <label class="form-check-label" for="common_interest">
                    Interés Común
                </label>
            </div>

            <div class="form-check d-flex">
                <input class="form-check-input align-self-center" type="checkbox" value="G" name="type[]" id="business">
                <label class="form-check-label" for="business">
                    Negocios
                </label>
            </div>

            <div class="form-check d-flex">
                <input class="form-check-input align-self-center" type="checkbox" value="H" name="type[]" id="fractional">
                <label class="form-check-label" for="fractional">
                    Fracccional
                </label>
            </div>

            <div class="form-check d-flex mb-4">
                <input class="form-check-input align-self-center" type="checkbox" value="I" name="type[]" id="multi_family">
                <label class="form-check-label" for="multi_family">
                    Multi Familiar
                </label>
            </div>
            
            <label for="limit">Limitar cantidad</label>
            <input type="number" name="limit" id="limit" class="form-control mb-4" min="1" placeholder="Sin Límite">
            
            <input type="submit" name="submit" value="Actualizar" class="btn btn-success w-100">

        </form>
    </div>
    
    <div class="col-12 col-lg-5 col-xxl-4 bg-white p-4 border border-1 rounded-3 mx-2 align-self-start">
        <h2 class="fs-5">Traducir propiedades de Flex MLS</h2>
        <p class="fs-6 text-secondary">Esta accion no traduce literalmente el post, solo crea su versión de inglés para poder ser mostrado en el sitio web en Inglés.</p>

        <form action="" method="post">
            <input type="submit" name="translate_listings" value="Actualizar" class="btn btn-primary w-100">

        </form>

    </div>

</div>
