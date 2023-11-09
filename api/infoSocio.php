<?php
// Incluir tu archivo de configuración
require_once '../conn/conexion.php';
// Configurar encabezados para permitir solicitudes desde cualquier origen (CORS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

try {
    // Crear instancia de PDO usando tu configuración
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass, $options);

    // Realizar la consulta
    $sql = "SELECT ID_Socio, Nombre, Apellido, CorreoElectronico, NumeroTelefono, Direccion, FechaInsercion, FechaActualizacion, ID_Colegio FROM fnc.socios";
    $result = $pdo->query($sql);

    // Obtener los resultados como un array asociativo
    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    // Devolver la respuesta como JSON
    echo json_encode($data);
} catch (PDOException $e) {
    // Manejar errores de conexión o consulta
    echo json_encode(array('error' => 'Error de conexión a la base de datos.'));
}
?>
