<?php

// http://stackoverflow.com/a/13087678
function get_server_url($full = false)
{
    $s = &$_SERVER;
    $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true : false;
    $sp = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port = $s['SERVER_PORT'];
    $port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
    $host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
    $uri = $protocol . '://' . $host . ($full ? $s['REQUEST_URI'] : '');
    $segments = explode('?', $uri, 2);
    $url = $segments[0];
    return $url;
}

// renderiza una vista pasandole el nombre/ruta del archivo
// y un array asociativo con las variables que se inyectaran
function render_view($file, $vars = [])
{
    extract($vars);
    include(__DIR__ . '/../views/' . $file);
}
