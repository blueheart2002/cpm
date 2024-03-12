<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "licenta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT (SELECT nume FROM meeting WHERE id = p.id_meeting) as nume,
                               (SELECT categorie FROM meeting WHERE id = p.id_meeting) as categorie
                                FROM participanti p 
                                WHERE id_angajat = (SELECT id FROM angajati WHERE adresa_email = ?) ");

$stmt->bind_param("s", $email);

$email = $_GET['email'];

if (!$stmt->execute()) {
    die("Eroare la executarea declarației SQL: " . $stmt->error);
}
 
$stmt->bind_result($nume, $categorie);

while ($stmt->fetch()) {
    echo "$nume,$categorie<br>";
}

$stmt->close();
$conn->close();
?>

