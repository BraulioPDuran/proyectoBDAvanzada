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
$sql = "SELECT CONCAT(p.nombre,' ', p.apellido1,' ', p.apellido2) AS nombre_profesor, AVG(m.nota) AS promedio
FROM profesor p
JOIN impartir i ON p.idProfesor = i.idProfesor
JOIN asignatura a ON i.idAsignatura = a.idAsignatura
JOIN matricula m ON a.idAsignatura = m.idAsignatura
GROUP BY nombre_profesor
ORDER BY promedio DESC
LIMIT 10"; // Cambia 'tu_tabla' por el nombre de tu tabla
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