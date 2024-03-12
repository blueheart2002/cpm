<?php
// Verifică dacă s-au trimis datele prin POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectare la baza de date
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "licenta";

    // Creare conexiune
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificare conexiune
    if ($conn->connect_error) {
        die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
    }

    // Preia datele din formular
    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $email = $_POST['email'];
    $parola = $_POST['parola'];
    $conf_parola = $_POST['conf_parola'];

    // Adăugare intrare nouă în baza de date pentru angajati
    $stmt = $conn->prepare("INSERT INTO angajati (nume, prenume, functia, departament, id_tara, id_locatie, adresa_email,experienta, parola) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Eroare la pregătirea declarației SQL: " . $conn->error);
    }
    // Setare implicită pentru câmpurile functia, departament, id_tara și id_locatie
    $functia = 'implicit';
    $departament = 'implicit';
    $id_tara = 0;
    $id_locatie = 0;
    $experienta = 0;
    $stmt->bind_param("ssssiisis", $nume, $prenume, $functia, $departament, $id_tara, $id_locatie, $email,$experienta, $parola);
    if (!$stmt->execute()) {
        die("Eroare la executarea declarației SQL: " . $stmt->error);
    }
    $stmt->close();

    // Închidere conexiune
    $conn->close();
}
?>

<script>
    document.location.href = "index.html";
</script>
