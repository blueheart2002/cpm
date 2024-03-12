<?php
// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "licenta";

// Creare conexiune
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificare conexiune
if ($conn->connect_error) {
    echo "Nu mai merge nimic";
    die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
}

$sql = "SELECT COUNT(*) FROM angajati";

// Execută interogarea și obține rezultatul
$result = $conn->query($sql);

echo $result;
?>
