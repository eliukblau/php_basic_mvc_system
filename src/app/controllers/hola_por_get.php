<?php

function hola() {
    $mensaje = 'Hola Mundo por GET desde un script';
    render_view('hola.html', compact('mensaje'));
}
