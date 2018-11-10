<?php

$_APP_ROUTES = [

    // EJEMPLO DE LA SINTAXIS:
    // 'METODO /ruta' => funcion_anonima,
    // 'METODO /ruta' => ['ruta_fisica/script.php', 'nombre_funcion_o_metodo_de_clase'],
    //
    // DONDE EL METODO PUEDE SER GET/POST

    'GET /hola1' => function () { echo '<h1>Hola Mundo por GET<h1>'; },
    'GET /hola2' => ['controllers/hola_por_get.php', 'hola'],

    'POST /hola1' => function () { echo '<h1>Hola Mundo por POST<h1>'; },
    'POST /hola2' => ['controllers/hola_por_post.php', 'hola'],

];
