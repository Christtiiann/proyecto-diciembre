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

// function assignarCodi() {
//     // Llegeix el fitxer JSON
//     $dades = json_decode(file_get_contents('dades.json'), true);

//     // Assigna codis als videojocs
//     foreach ($dades as $videojoc) {
//         if (!isset($videojoc['codi'])) {
//             $videojoc['codi'] = generarCodiUnic();
//         }
//     }

//     // Sobreescriu el fitxer JSON
//     file_put_contents('dades.json', json_encode($dades, JSON_PRETTY_PRINT));
// }

// function generarCodiUnic() {
    
//     // Implementa la lògica per generar codis únics
// }

// Cargar y decodificar datos del archivo JSON
$dades = json_decode(file_get_contents('dades.json'), true);

// Tu función para asignar códigos a los videojuegos
function generarCodiUnic() {
     static $id = 0; // Utilizamos una variable estática para mantener el valor entre llamadas
    return  $id++; // Devolvemos el ID con el valor actual de $id y luego lo incrementamos
}

function asignarCodi(&$dades) {
    $id = 0; // Inicializar el identificador
    foreach ($dades as &$videojoc) {
        $videojoc['id'] = generarCodiUnic(); // Asignar un nuevo código único
        $id++; // Incrementar el id para el próximo juego
    }
file_put_contents('dades.json', json_encode($dades, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));

echo "<br>";
echo "<table border='1'>";

foreach ($dades as $videojoc) {
    echo "<tr>";
    foreach ($videojoc as $nombreCampo => $codi) {
        echo "<td>$nombreCampo: $codi</td>";
    }
    echo "</tr>";
}

echo "</table>";
echo "<br>";
}

function eliminar_por_fecha($fecha_inicio, $fecha_fin, &$dades) {
    $videojuegos_eliminar = [];

    foreach ($dades as $key => $videojoc) {
        $fecha_videojuego = strtotime($videojoc["Llançament"]);
        $fecha_inicio = strtotime($fecha_inicio);
        $fecha_fin = strtotime($fecha_fin);

        if ($fecha_videojuego >= $fecha_inicio && $fecha_videojuego <= $fecha_fin) {
            $videojuegos_eliminar[] = $key;
        }
    }

    foreach ($videojuegos_eliminar as $key) {
        unset($dades[$key]);
    }
    
    file_put_contents('games_fil.json', json_encode($dades, JSON_PRETTY_PRINT));
// Mostrar los datos en una tabla si es necesario
echo "<br>";
echo "<table border='1'>";

foreach ($dades as $videojoc) {
    echo "<tr>";
    foreach ($videojoc as $nombreCampo => $codi) {
        echo "<td>$nombreCampo: $codi</td>";
    }
    echo "</tr>";
}

echo "</table>";
echo "<br>";
}
function calcularFechaExpiracion($videojoc) {
    // Calcula la fecha de expiración sumando 5 años a la fecha de desarrollo
    $videojoc = $videojoc["Llançament"];
    $fechaExpiracion = $videojoc->modify('+5 years')->format('Y-m-d');
    return $fechaExpiracion;
}

function añadirFechaExpiracion($dades) {
    // Añade la fecha de expiración a cada videojuego en los datos
    foreach ($dades as &$videojoc) {
        $videojoc['data_expiracio'] = calcularFechaExpiracion($videojoc);
    }

    return $dades;
}

function guardarDatosEnJSON($dades, $nombreArchivo) {
    // Guarda los datos actualizados en un nuevo archivo JSON
    $json_resultado = json_encode($dades, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

    if ($json_resultado === false) {
        echo "Error al codificar los datos a JSON.";
        return;
    }

    // Guarda el JSON en un nuevo archivo
    file_put_contents($nombreArchivo, $json_resultado);

    echo "Datos actualizados guardados en $nombreArchivo.";
}
/*
function generarCodiUnic() {
     $codi = 'id' . uniqid();
    return $codi;
}

*/
?>

