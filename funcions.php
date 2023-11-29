<?php
function cargarDatos() {
    // Intenta leer el archivo JSON
    $json_content = file_get_contents('dades.json');

    if ($json_content === false) {
        echo "Error al leer el archivo JSON.";
        return null;
    }

    // Intenta decodificar el JSON
    $dades = json_decode($json_content, true);

    if ($dades === null) {
        echo "Error al decodificar el JSON. Verifica que el JSON sea válido.";
        return null;
    }

    // Verifica si hay datos en $dades
    if (empty($dades)) {
        echo "No hay datos disponibles en el archivo JSON.";
        return null;
    }

    return $dades;
}

function mostrarTabla($dades) {
    // Muestra los videojuegos en una tabla con diseño atractivo
    echo "<table border='1'>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Desenvolupador</th>
                    <th>Plataforma</th>
                    <th>Llançament</th>
                    <!-- Otras cabeceras -->
                </tr>
            </thead>
            <tbody>";

    foreach ($dades as $videojoc) {
        echo "<tr>
                <td>{$videojoc['Nom']}</td>
                <td>{$videojoc['Desenvolupador']}</td>
                <td>{$videojoc['Plataforma']}</td>
                <td>{$videojoc['Llançament']}</td>
                <!-- Otras celdas con datos de los videojuegos -->
              </tr>";
    }

    echo "</tbody>
        </table>";
}

function assignarCodi() {
    // Llegeix el fitxer JSON
    $dades = json_decode(file_get_contents('dades.json'), true);

    // Assigna codis als videojocs
    foreach ($dades as $videojoc) {
        if (!isset($videojoc['codi'])) {
            $videojoc['codi'] = generarCodiUnic();
        }
    }

    // Sobreescriu el fitxer JSON
    file_put_contents('dades.json', json_encode($dades, JSON_PRETTY_PRINT));
}

function generarCodiUnic() {
    // Implementa la lògica per generar codis únics
}


?>