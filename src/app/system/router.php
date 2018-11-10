<?php

$_APP_ROUTES = []; // placeholder!
require_once(__DIR__ . '/../routes.php'); // archivo con las rutas USER CUSTOM

// clausura para que las variables declaradas dentro no sean visible desde otros scripts!
(function () use ($_APP_ROUTES) {

    // parseamos el query string completo
    $query = [];
    if (isset($_SERVER['QUERY_STRING'])) {
        parse_str($_SERVER['QUERY_STRING'], $query);
    }

    // obtenemos el metodo de request (GET, POST)
    $method = strtoupper($_SERVER['REQUEST_METHOD']);

    // obtenemos la query string con la ruta ( _ ) solicitada
    // [ la ruta se pasa de la siguiente manera: http://host?_=/ruta ]
    $route = isset($query['_']) ? $query['_'] : null;

    /*
    var_dump($method);
    var_dump($query);
    var_dump($route);
    var_dump($_APP_ROUTES);
    */

    $key = sprintf('%s %s', $method, $route);
    if ($route !== null && isset($_APP_ROUTES[$key])) {
        if (is_callable($_APP_ROUTES[$key])) {   // si es una funcion o un metodo de clase
            call_user_func($_APP_ROUTES[$key]);  // ejecutamos la funcion o metodo de clase
            return;                              // TERMINAMOS AQUI!
        }
        else if (is_array($_APP_ROUTES[$key])) {                // si es un array
            include(__DIR__ . '/../' . $_APP_ROUTES[$key][0]);  // cargamos el script
            call_user_func($_APP_ROUTES[$key][1]);              // ejecutamos la funcion o metodo de clase
            return;                                             // TERMINAMOS AQUI!
        }
    }

    // SI NO ES UNA RUTA VALIDA O ESTA INCORRECTAMENTE DECLARADA, VAMOS A 404 !!!
    header('HTTP/1.0 404 Not Found', true, 404);
    render_view('404.html');
    exit();

})();
