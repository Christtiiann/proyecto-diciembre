<?php
include('menu.html');
include('funcions.php');
// Carga los datos
$dades = cargarDatos();

// Añade la fecha de expiración a los datos
if ($dades !== null) {
    $dadesConFechaExpiracion = añadirFechaExpiracion($dades);

    // Guarda los datos actualizados en un nuevo archivo JSON
    guardarDatosEnJSON($dadesConFechaExpiracion, 'JSON_Resultat_Data_Expiracio.json');

    // Muestra la tabla con los datos originales
    mostrarTabla($dades);

    // Muestra la tabla con los datos actualizados (opcional)
    // mostrarTabla($dadesConFechaExpiracion);
}


?>
