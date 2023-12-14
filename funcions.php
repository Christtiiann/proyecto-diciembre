<?php
function cargarDatos($fileName = "dades.json") {
    // Intenta leer el archivo JSON
    $json_content = file_get_contents($fileName);

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
function mostrarExpiracio($dades) {
    // Muestra los videojuegos en una tabla con diseño atractivo
    echo "<table border='1'>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Desenvolupador</th>
            <th>Plataforma</th>
            <th>Llançament</th>
            <th>id</th>
            <th>data_expiracio</th>
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
        <td>{$videojoc['id']}</td>
        <td>{$videojoc['data_expiracio']}</td>
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
echo "<table border='1'>
<thead>
    <tr>
        <th>Nom</th>
        <th>Desenvolupador</th>
        <th>Plataforma</th>
        <th>Llançament</th>
        <th>id</th>
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
    <td>{$videojoc['id']}</td>
    <!-- Otras celdas con datos de los videojuegos -->
  </tr>";
}

echo "</tbody>
</table>";
}
function eliminaVideojocs($data1, $data2) {
    // Llegeix el fitxer JSON
    $dades = json_decode(file_get_contents('dades.json'), true);

    // Filtra els videojocs amb data de llançament entre les dates donades
    $dadesFiltrades = array_filter($dades, function ($videojoc) use ($data1, $data2) {
        return $videojoc['Llançament'] >= $data1 && $videojoc['Llançament'] <= $data2;
    });

    // Crea el fitxer JSON_Resultat_Eliminar.json amb les dades filtrades
    file_put_contents('JSON_Resultat_Eliminar.json', json_encode($dadesFiltrades, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
    $dades = json_decode(file_get_contents('JSON_Resultat_Eliminar.json'), true);
     // Mostrar los datos en una tabla si es necesario
echo "</tbody>
 </table>";
}


// function eliminar_por_fecha($fecha_inicio, $fecha_fin, &$dades) {
//     $videojuegos_eliminar = [];

//     foreach ($dades as $key => $videojoc) {
//         $fecha_videojuego = strtotime($videojoc["Llançament"]);
//         $fecha_inicio = strtotime($fecha_inicio);
//         $fecha_fin = strtotime($fecha_fin);

//         if ($fecha_videojuego >= $fecha_inicio && $fecha_videojuego <= $fecha_fin) {
//             $videojuegos_eliminar[] = $key;
//         }
//     }

//     foreach ($videojuegos_eliminar as $key) {
//         unset($dades[$key]);
//     }
    
//     file_put_contents('games_fil.json', json_encode($dades, JSON_PRETTY_PRINT));
// // Mostrar los datos en una tabla si es necesario
// echo "<br>";
// echo "<table border='1'>";

// foreach ($dades as $videojoc) {
//     echo "<tr>";
//     foreach ($videojoc as $nombreCampo => $codi) {
//         echo "<td>$nombreCampo: $codi</td>";
//     }
//     echo "</tr>";
// }

// echo "</table>";
// echo "<br>";
// }
 function calcularFechaExpiracion($videojoc) {
     // Calcula la fecha de expiración sumando 5 años a la fecha de desarrollo
     $videojoc = strtotime($videojoc["Llançament"]);
     $fechaExpiracion =strtotime("+5 Years", $videojoc);
     return date("Y-m-d", $fechaExpiracion);
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
function comprovaRepetits() {
    // Llegeix el fitxer JSON
    $dades = json_decode(file_get_contents('dades.json'), true);

    // Inicialitza un array per emmagatzemar els noms dels videojocs
    $nomsVideojocs = array();

    // Comprova si hi ha registres repetits
    foreach ($dades as $videojoc) {
        $nom = $videojoc['Nom'];
        if (in_array($nom, $nomsVideojocs)) {
            echo "Hi ha registres repetits amb el nom: $nom";
            return 1;
        }
        $nomsVideojocs[] = $nom;
    }

    echo "No hi ha registres repetits.";
    return 0;
}
function comprovaRepetitsAmpliada() {
    // Llegeix el fitxer JSON
    $dades = json_decode(file_get_contents('dades.json'), true);

    // Inicialitza un array per emmagatzemar els noms dels videojocs repetits
    $nomsRepetits= [];
    $elementsvist= [];

    // Comprova si hi ha registres repetits
    foreach ($dades as $videojoc) {
        $nom = $videojoc['Nom'];
        if (in_array($nom, $elementsvist)) {
            $nomsRepetits[] = $videojoc;
        } else {
            $elementsvist[] = $nom;
        }
    }

    // Crea el fitxer JSON_Resultat_repetits.json amb els registres repetits
    // $resultatJson = array('registres_repetits' => $nomsRepetits);
    file_put_contents('JSON_Resultat_repetits.json', json_encode($nomsRepetits, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE));
}
function eliminaRepetits() {
    // Llegeix el fitxer JSON
    $dades = json_decode(file_get_contents('dades.json'), true);

    // Inicialitza un array per emmagatzemar els noms dels videojocs
    $nomsVideojocs = array();

    // Filtra els videojocs eliminant els repetits
    $dadesFiltrades = array_filter($dades, function ($videojoc) use (&$nomsVideojocs) {
        $nom = $videojoc['Nom'];
        if (!in_array($nom, $nomsVideojocs)) {
            $nomsVideojocs[] = $nom;
            return true;
        }
        return false;
    });

    // Crea el fitxer JSON_Resultat_eliminar_repetits.json amb les dades filtrades
    file_put_contents('JSON_Resultat_eliminar_repetits.json', json_encode($dadesFiltrades, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE));
}
function mostraExtrems() {
    // Llegeix el fitxer JSON
    $dades = json_decode(file_get_contents('dades.json'), true);

    // Inicialitza variables per a les dates més moderna i més antiga
    $dataMesModerna = '';
    $dataMesAntiga = "20-12-2050";

    // Inicialitza variables per emmagatzemar els videojocs més modern i més antic
    $videojocMesModerna = null;
    $videojocMesAntic = null;

    // Cerca el videojoc més modern i el més antic
    foreach ($dades as $videojoc) {
        $dataLlancament = strtotime($videojoc['Llançament']);

        if ($dataLlancament > strtotime($dataMesModerna)) {
            $dataMesModerna = date('Y-m-d', $dataLlancament);
            $videojocMesModerna = $videojoc;
        }
          
        if ($dataLlancament < strtotime($dataMesAntiga)) {
            $dataMesAntiga = date('Y-m-d', $dataLlancament);
            $videojocMesAntic = $videojoc;
        }
    }

    // Mostra les dades del videojoc més modern
    echo "<h2>Videojoc més modern:</h2>";
    mostrarDetallsVideojoc($videojocMesModerna);

    // Mostra les dades del videojoc més antic
    echo "<h2>Videojoc més antic:</h2>";
    mostrarDetallsVideojoc($videojocMesAntic);
}

// Funció per mostrar detalls d'un videojoc
function mostrarDetallsVideojoc($videojoc) {
    echo "<p>Nom: {$videojoc['Nom']}</p>";
    echo "<p>Desenvolupador: {$videojoc['Desenvolupador']}</p>";
    echo "<p>Data de Llançament: {$videojoc['Llançament']}</p>";
    // Altres detalls del videojoc
}

function comptarVideojocsPerAny() {
    // Llegeix el fitxer JSON
    $dades = json_decode(file_get_contents('dades.json'), true);

    // Inicialitza un array per comptar els videojocs per any
    $videojocsPerAny = array();

    // Compta els videojocs per any
    foreach ($dades as $videojoc) {
        $anyCreacio = date('Y', strtotime($videojoc['Llançament']));
        if (!isset($videojocsPerAny[$anyCreacio])) {
            $videojocsPerAny[$anyCreacio] = 1;
        } else {
            $videojocsPerAny[$anyCreacio]++;
        }
    }

    // Mostra el nombre de videojocs per a cada any
    echo "<h2>Comptador de Videojocs per Any:</h2>";
    echo "<ul>";
    foreach ($videojocsPerAny as $any => $nombreVideojocs) {
        echo "<li>Any $any: $nombreVideojocs videojocs</li>";
    }
    echo "</ul>";
}
function OrdenAlfabetico($dades) {
    $nom=array_column($dades,"Nom");
    array_multisort($nom, SORT_ASC, $dades);
    file_put_contents('JSON_Resultat_ordenat_alfabetic.json', json_encode($dades , JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE));
    echo "<br>";
echo "<table border='1'>";

foreach ($dades as $videojoc) {
    echo "<tr>";
    foreach ($videojoc as $nombreCampo ) {
        echo "<td>$nombreCampo</td>";
    }
    echo "</tr>";
}

echo "</table>";
echo "<br>";
}

/*
function generarCodiUnic() {
     $codi = 'id' . uniqid();
    return $codi;
}

*/
?>

