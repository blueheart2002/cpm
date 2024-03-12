<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "licenta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
}

$email = $_GET['email'];
$nume = $_GET['nume'];
$prenume = $_GET['prenume'];
$functia = $_GET['functia'];
$departament = $_GET['departament'];
$tara = $_GET['tara'];
$oras = $_GET['oras'];

$stmt = $conn->prepare("UPDATE angajati SET nume = ?, prenume = ?, functia = ?, departament = ?, 
                        id_tara = (SELECT id_tara FROM tari WHERE nume = ?),
                        id_locatie = (SELECT id_locatie FROM locatii WHERE nume_oras = ?)
                        WHERE adresa_email = ?");

if (!$stmt) {
    die("Eroare la pregătirea declarației SQL: " . $conn->error);
}

$stmt->bind_param("sssssss",$nume, $prenume, $functia, $departament, $tara, $oras, $email);

if (!$stmt->execute()) {
    die("Eroare la executarea declarației SQL: " . $stmt->error);
}

$stmt->close();

$conn->close();
?>

