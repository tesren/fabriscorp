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

    $zones = [
        "1 de Mayo",
        "5 de Diciembre",
        "Adolfo Lopez Mateos",
        "Agua Azul",
        "Ajijic",
        "Alta Mita",
        "Alta Vista",
        "Amapas",
        "Americana",
        "Aquiles Serdan",
        "Aralias",
        "Aramara",
        "Arboledas",
        "Arcos Sur",
        "Arcos Vallarta",
        "Aurora",
        "B Nayar",
        "Barra de Navidad",
        "Barranquitas",
        "Barrio de Sta. Maria",
        "Becerra",
        "Benito Juarez",
        "Bobadilla",
        "Boca de Tomatlan",
        "Bolongo",
        "Brisas del Pacifico I y II",
        "Bucerias Centro",
        "Buenos Aires",
        "Bugambilias",
        "Cajon de Pena",
        "Camino Real",
        "Campo de Golf",
        "Canal",
        "Careyeros",
        "Central Camioneras",
        "Centro",
        "Centro Ixtapa",
        "Chacala",
        "Chalacatepec",
        "Circunvalacion",
        "Ciudad del Sol",
        "Coapinole",
        "Colinas de San Javier",
        "Del Mar",
        "Del Parque",
        "Del Pedregal",
        "Destiladeras",
        "Educacion",
        "El Anclote",
        "El Banco",
        "El Caloso",
        "El Calvario",
        "El Centro",
        "El Cerro",
        "El Farallon",
        "El Magisterio",
        "El Mangal",
        "El Nogalito",
        "El Tigre",
        "El Tizate",
        "El Toro",
        "El Tuito",
        "Emiliano Zapata",
        "Ex Haciendas de Pitillal",
        "Fluvial",
        "Garza Blanca",
        "Gastronomicos",
        "Gran Venetian - Icon Area",
        "Gringo Gulch",
        "Guadalupe Victoria",
        "Guayabitos",
        "Gustavo Diaz Ordaz",
        "Hacienda Los Sauces",
        "Hermosa Provincia",
        "Higuera Blanca",
        "Ikal",
        "Independencia",
        "Ipala",
        "Isla Iguana",
        "Jardines",
        "Jardines Alcalde",
        "Jardines de Higuera",
        "Jardines de Ixtapa",
        "Jardines de Las Gaviotas",
        "Jardines del Bosque",
        "Jardines del Country",
        "Jardines del Puerto",
        "Jardines Universidad",
        "Jarretaderas",
        "Jose Chavez",
        "Joyas del Pedegral",
        "La Cruz Centro",
        "La Cruz de Loreto",
        "La Desembocada",
        "La Esperanza",
        "La Experiencia",
        "La Floresta",
        "La Herradura",
        "La Magdalena",
        "La Mandarina",
        "La Normal",
        "La Pechuga",
        "La Penita",
        "La Playa Estates",
        "La Playita",
        "La Primavera",
        "La Puntilla",
        "Las Canadas",
        "Las Canoas",
        "Las Ceibas",
        "Las Gaviotas",
        "Las Glorias",
        "Las Juntas",
        "Las Juntas y Los Veranos",
        "Las Moras",
        "Las Palmas",
        "Las Penas",
        "Las Varas",
        "Lazaro Cardenas",
        "Leandro Valle",
        "Linda Vista",
        "Litibu",
        "Lo de Marcos",
        "Loma de Enmedio",
        "Lomas de La Victoria",
        "Lomas del Calvario",
        "Lomas del Coapinole",
        "Lomas del Valle",
        "Lomas Universidad",
        "Los Arboles",
        "Los Ayalas",
        "Los Delfines",
        "Los Mangos",
        "Los Pinos",
        "Los Ramblases",
        "Los Tigres",
        "Los Tules",
        "Los Veneros",
        "Lower Conchas Chinas",
        "Manuel Obando",
        "Marbella",
        "Marina Vallarta",
        "Mascota",
        "Mayan Palace",
        "Mayto",
        "Mismaloya",
        "Mojoneras",
        "Monterrey",
        "Montessori",
        "Morelos",
        "Naranjito",
        "Naranjo",
        "Nayarit Costa Norte",
        "Nuevo Vallarta Centro",
        "Nuevo Vallarta Este",
        "Nuevo Vallarta Oeste",
        "Oasis",
        "Olas Altas",
        "Olivos",
        "Olivares",
        "Ostioneria",
        "Palm Springs",
        "Palmar de Aramara",
        "Palmar del Progreso",
        "Palo Maria",
        "Paraíso",
        "Paraiso Las Palmas",
        "Parota",
        "Paso Ancho",
        "Patricia",
        "Pavilion",
        "Pedregal",
        "Pinal Villa",
        "Pitillal Centro",
        "Platanitos",
        "Playa Blanca",
        "Playa del Sol",
        "Playa Esmeralda",
        "Playa Gemelas",
        "Playa Grande",
        "Playa Las Tortugas",
        "Playa Los Venados",
        "Playa Nuevo Vallarta",
        "Playas de Huanacaxtle",
        "Poncitlan",
        "Potrero",
        "Prados Vallarta",
        "Primavera",
        "Progreso",
        "Punta Arena",
        "Punta de Mita",
        "Punta de Mita Centro",
        "Quinta de Sta. Maria",
        "Quinta San Miguel",
        "Ranchitos",
        "Remance",
        "Residencial Victoria",
        "Rincon del Cielo",
        "Rincon del Cielo I",
        "Rincon del Cielo II",
        "Rinconada de Las Palmas",
        "Rinconada de Las Palmas II",
        "Rinconada de Los Fresnos",
        "Rinconada del Bosque",
        "Rinconada del Refugio",
        "Rincones del Marques",
        "Rio de Las Amapas",
        "Rio Pitillal Abajo",
        "Rivera Molino",
        "Romantic Zone",
        "Rosita",
        "Royale",
        "Rufino Tamayo",
        "San Esteban",
        "San Juan de Abajo",
        "San Pancho",
        "San Sebastián",
        "Santa Barbara",
        "Santa Fe",
        "Santa Maria",
        "Santa Maria del Oro",
        "Sayulita",
        "Sayan",
        "Solidaridad",
        "Talpa",
        "Tamarindo",
        "Tecolote",
        "Terralta & Los Amores",
        "Tinajas",
        "Tomatlan",
        "Torreblanca",
        "Tres Estrellas",
        "Urbivilla del Roble",
        "Valle Alto",
        "Valle Dorado",
        "Valle Escondido",
        "Valle Flamingos",
        "Valle Jalisco",
        "Valle Dorado",
        "Versalles",
        "Villa 5 de Diciembre",
        "Villa Del Mar",
        "Villa Las Flores",
        "Villa Las Palmas",
        "Villa Patricia",
        "Villa Real del Mar",
        "Villa Vallarta",
        "Villas Alpuyeque",
        "Villas Altas",
        "Villas Bugambilias",
        "Villas Calipso",
        "Villas Las Palmas",
        "Villas Rio",
        "Villas San Jose del Valle",
        "Villas Santa Rita",
        "Villas Universidad",
        "Vista Alegre",
        "Vista del Sol",
        "Vista Dorada",
        "Vista Encantada",
        "Vista Lagos",
        "Vista Mar",
        "Vista Vallarta",
        "Xochimilco",
        "Zapata",
        "Zona Comercial",
        "Zona Dorada",
        "Zona Hotelera",
        "Zona Industrial",
        "Zona Militar",
        "Zona Romántica",
        "Zona Urbana",
        "Zona Valle",
        "Zona Versalles",
        "Zona Viva"
    ];
    
?>

<div class="bg-white">
    <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" class="row">

        <input type="hidden" placeholder="Search" value="<?php the_search_query() ?>" name="s" title="Search"/>

        <input type="hidden" value="listing" name="post_type"/>

        <div class="row justify-content-center">
            
            <!-- <div class="form-floating">
                <select name="zona" id="zona" class="form-select py-3" aria-label="Zona">
                    <option value=""><?php pll_e('Cualquier Zona') ?></option>
                    <?php foreach($zones as $zone): ?>
                        <option value="<?= $zone ?>"><?= $zone ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="zona" class="text-secondary"><i class="fa-solid text-yellow fa-bed"></i> <?php pll_e('Zona') ?></label>
            </div> -->

            
            <div class="col-12 col-lg-2 px-0 text-center">
                <label for="zona" class="text-secondary"><i class="fa-solid text-yellow fa-location-dot"></i> <?php pll_e('Zona') ?></label>
                <select name="zona" id="zona" class="align-self-end rounded-0 d-flex w-100" aria-label="Zona">
                    <option value=""><?php pll_e('Cualquier Zona') ?></option>
                    <?php foreach($zones as $zone): ?>
                        <option value="<?= $zone ?>"><?= $zone ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            

            <div class="col-12 col-lg-3 px-0 text-center">
                <label for="tipo_propiedad" class="text-secondary" style="margin-bottom:2px;"><i class="fa-solid text-yellow fa-house-chimney"></i> <?php pll_e('Tipo de propiedad') ?></label>
                <select class="form-select py-3 rounded-0" id="tipo_propiedad" aria-label="<?php pll_e('Tipo de propiedad') ?>" name="tipo_propiedad">

                    <option value=""><?php pll_e('Todo') ?></option>

                    <option <?php if($property_type=='A'){echo 'selected';} ?> value="A"><?php pll_e('Condominios') ?></option>
                    <option <?php if($property_type=='B'){echo 'selected';} ?> value="B"><?php pll_e('Casas y Villas') ?></option>
                    <option <?php if($property_type=='E'){echo 'selected';} ?> value="E"><?php pll_e('Lotes y Terrenos') ?></option>
                    <option <?php if($property_type=='G'){echo 'selected';} ?> value="G"><?php pll_e('Negocios') ?></option>
                    <option <?php if($property_type=='I'){echo 'selected';} ?> value="I"><?php pll_e('Multi Familiar') ?></option>

                </select>
            </div>

            <div class="col-12 col-lg-2 px-0 text-center">
                <label for="recamaras" class="text-secondary" style="margin-bottom:2px;"><i class="fa-solid text-yellow fa-bed"></i> <?php pll_e('Recámaras') ?></label>
                <input type="number" name="recamaras" id="recamaras" min="1" max="99" class="form-control py-3 rounded-0" placeholder="1" value="<?= $old_bedrooms ?>">
            </div>

            <div class="col-12 col-lg-2 px-0 text-center">
                <label for="min_price" class="text-secondary" style="margin-bottom:2px;"><i class="fa-solid text-yellow fa-dollar-sign"></i> Precio Min.</label>
                <select class="form-select py-3 rounded-0" id="min_price" name="min_price" aria-label="Floating label select example">
                    <option value="0" <?php echo $old_min_price == 0 ? 'selected' : ''; ?>>Sin mínimo</option>
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


            <div class="col-12 col-lg-2 px-0 text-center">
                <label for="max_price" class="text-secondary" style="margin-bottom:2px;"><i class="fa-solid text-yellow fa-dollar-sign"></i> Precio Max.</label>
                <select class="form-select py-3 rounded-0" id="max_price" name="max_price" aria-label="Floating label select example">
                    <option value="90000000" <?php echo $old_max_price == 0 ? 'selected' : ''; ?>>Sin Máximo</option>
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

            <input type="hidden" name="submit" value="<?php pll_e('Search');?>">

            <button class="btn btn-yellow col-12 col-lg-1 align-self-end py-3 rounded-0" type="submit" style="margin-top:2px;">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

        </div>

    </form>
</div>