<?php


// Incluye la página HTML con el diseño
include('menu.html');
include('funcions.php');
// Carga los datos
$dades = cargarDatos();
// Muestra la tabla si los datos se han cargado correctamente
comprovaRepetitsAmpliada($dades);
$dades = cargarDatos("JSON_Resultat_repetits.json");
mostrarTabla($dades);
?>