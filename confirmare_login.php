<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "licenta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "Nu mai merge nimic";
    die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM angajati WHERE adresa_email = ? AND parola = ?");
$stmt->bind_param("ss", $email, $parola);
$email = $_GET['email'];
$parola = $_GET['parola'];
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

$conn->close();

if($count > 0)
echo "exista";
else echo "nu_exista";
?>