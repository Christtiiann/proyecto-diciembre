<?php

// Incluye la página HTML con el diseño
include('menu.html');
include('funcions.php');
// Carga los datos
$dades = cargarDatos();
// Muestra la tabla si los datos se han cargado correctamente
eliminar_por_fecha('2017-01-01', '2020-12-31', $dades);
?>