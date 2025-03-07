<?php
$servername = "localhost";
$username = "root"; // Usuario por defecto de XAMPP
$password = "root"; // Contraseña por defecto de XAMPP
$dbname = "facultad"; // Cambia esto por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL
$sql = "SELECT CONCAT(a.nombre, ' ',a.apellido1, ' ',a.apellido2) AS nombre_completo, a.email, a.direccion, a.codigoPostal FROM alumno a"; // Cambia 'tu_tabla' por el nombre de tu tabla
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    // Recorrer los resultados y añadirlos al array $data
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "0 resultados";
}

// Devolver los datos en formato JSON
echo json_encode($data);

$conn->close();


?>