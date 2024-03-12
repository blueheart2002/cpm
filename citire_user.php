<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "licenta";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
}



$stmt = $conn->prepare("SELECT nume, 
                               prenume, 
                               functia, 
                               departament, 
                               (SELECT nume FROM tari WHERE id_tara = a.id_tara) as tara,
                               (SELECT nume_oras FROM locatii WHERE id_locatie = a.id_locatie) as oras
                               FROM angajati a WHERE adresa_email = ?");

$stmt->bind_param("s", $email);

$email = $_GET['email'];

if (!$stmt->execute()) {
    die("Eroare la executarea declarației SQL: " . $stmt->error);
}
 
$stmt->bind_result($nume, $prenume, $functia, $departament, $tara, $oras);
$stmt->fetch();

echo "$nume<br>$prenume<br>$functia<br>$departament<br>$tara<br>$oras<br>";

$stmt->close();

$conn->close();
?>

