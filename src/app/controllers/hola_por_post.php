<?php

function hola() {
    $mensaje = 'Hola Mundo por POST desde un script';
    render_view('hola.html', compact('mensaje'));
}
