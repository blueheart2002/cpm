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

$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM angajati WHERE adresa_email = ?");
$stmt->bind_param("s", $email);
$email = $_GET['email'];
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

// Închide conexiunea la baza de date
$conn->close();

// Returnează rezultatul interogării către JavaScript prin localStorage
// echo "<script>localStorage.setItem('email_exists', '$count');</script>";
if($count > 0)
echo "true";
else echo "false";
?>
