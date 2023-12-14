
<?php

// Incluye la página HTML con el diseño
include('menu.html');
include('funcions.php');
// Carga los datos
$dades = cargarDatos();
mostraExtrems($dades);
?>
