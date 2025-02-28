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
$sql = "SELECT p.categoria, p.nombre, p.apellido1, p.apellido2, GROUP_CONCAT(a.nombre  ,' ') AS materias_impartidas, GROUP_CONCAT(DISTINCT t.telefono, ' ') AS telefonos_contacto
FROM asignatura a
JOIN impartir i ON a.idAsignatura = i.idAsignatura
JOIN profesor p ON i.idProfesor = p.idProfesor
JOIN tlfcontactoprof t ON p.idProfesor = t.idProfesor
GROUP BY p.categoria, p.nombre, p.apellido1, p.apellido2"; // Cambia 'tu_tabla' por el nombre de tu tabla
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