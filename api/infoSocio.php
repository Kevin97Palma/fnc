<?php
// Incluir tu archivo de configuración
require_once '../conn/conexion.php';
// Configurar encabezados para permitir solicitudes desde cualquier origen (CORS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

try {
    // Crear instancia de PDO usando tu configuración
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass, $options);

    // Obtener el ID_Socio de la solicitud GET
    $idSocio = isset($_GET['ci']) ? $_GET['ci'] : null;

    if ($idSocio !== null) {
        // Si se proporciona un ID_Socio, construir y ejecutar la consulta con WHERE
        $sql = "SELECT ID_Socio,Cedula, Nombre, Apellido, CorreoElectronico, NumeroTelefono, Direccion, FechaInsercion, FechaActualizacion, ID_Colegio FROM fnc.socios WHERE Cedula = :ci";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':ci', $idSocio, PDO::PARAM_INT);
        $stmt->execute();
    } else {
        // Si no se proporciona un ID_Socio, realizar la consulta sin WHERE
        $sql = "SELECT ID_Socio,Cedula, Nombre, Apellido, CorreoElectronico, NumeroTelefono, Direccion, FechaInsercion, FechaActualizacion, ID_Colegio FROM fnc.socios";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        exit();  // Terminar la ejecución después de devolver la respuesta sin WHERE
    }

    // Obtener los resultados como un array asociativo
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver la respuesta como JSON
    echo json_encode($data);
} catch (PDOException $e) {
    // Manejar errores de conexión o consulta
    echo json_encode(array('error' => 'Error de conexión a la base de datos.'));
}
?>
