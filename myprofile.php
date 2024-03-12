<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilul Meu</title>
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            color: #333;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #ffc107;
            color: #333;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #ffca28;
        }
        .navbar {
            background-image: url('finalpoza2.jpeg');
            background-size: auto 100%; 
            background-position: center; 
            color: #333; 
            position: relative;
            height: 200px; 
            padding-top: 30px; 
        }
        .navbar-nav {
            position: absolute;
            left: 20px; 
            top: 220px;
            display: flex; 
            flex-direction: column; 
            gap: 10px; 
        }

        .option {
            transition: transform 0.3s ease; 
            background-color: #ffd700; 
            color: #333; 
            padding: 10px 20px;
            border-radius: 20px; 
            text-decoration: none; 
            font-weight: bold; 
            text-align: center; 
        }

        .selected-option {
            transition: transform 0.3s ease;
            background-color: #f5a105; 
            color: #333; 
            padding: 10px 20px; 
            border-radius: 20px; 
            text-decoration: none;
            font-weight: bold; 
            text-align: center; 
        }

        .option:hover {
            transform: translateY(-5px);
            background-color: #ffda3a; 
            color: #fff; 
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <!-- Imagine de copertă -->
            <img src="pozamea.png" alt="" class="cover-photo">
        </a>
        <!-- Opțiuni de navigație -->
        <div class="navbar-nav">
            <a href="index.html" class="option">Acasa</a>
            <a href="myprofile.php" class="selected-option">Profilul meu</a>
            <a href="istoric.php" class="option">Istoric Meetinguri</a>
            <a href="signup.php" class="option">Deconectati-va</a>
        </div>
    </nav>
    <div class="container">
        <h1>Profilul meu</h1>
        <form id="profilulMeu" action="" onsubmit="return validateData()">

            <label for="nume">Nume:</label>
            <input id="nume" value="" /><br><br>

            <label for="prenume">Prenume:</label>
            <input id="prenume" value="" /><br><br>

            <label for="functia">Functia:</label>
            <select id="functia" name="functia">
                <option value="Programator Junior">Programator Junior</option>
                <option value="Programator Senior">Programator Senior</option>
            </select><br><br>

            <label for="departament">Departament:</label>
            <select id="departament" name="departament">
                <option value="Research and Development">Research and Development</option>
                <option value="Sales">Sales</option>
            </select><br><br>

            <label for="tara">Tara:</label>
            <select id="tara" name="tara">
            </select><br><br>

            <label for="oras">Oras:</label>
            <select id="oras" name="oras">
            </select><br><br>
            
            <input type="submit" value="Salveaza datele">
        </form>
    </div>

    <script>
        
        function validateData() {
            var email = localStorage.getItem("user");
            var nume = document.getElementById("nume").value;
            var prenume = document.getElementById("prenume").value;
            var functia = document.getElementById("functia").value;
            var departament = document.getElementById("departament").value;
            var tara = document.getElementById("tara").value;
            var oras = document.getElementById("oras").value;

            fetch('update_user.php?email=' + email.toString() 
                                        + "&nume=" + nume.toString() 
                                        + "&prenume=" + prenume.toString()
                                        + "&functia=" + functia.toString() 
                                        + "&departament=" + departament.toString()
                                        + "&tara=" + tara.toString()
                                        + "&oras=" + oras.toString()
                                        )
            .then(response => {
                return response.text();
            })
            .then(
                data => {console.log(data);}
            )
            .catch(error => {
                console.error('A apărut o eroare:', error);
            });

            return true;
        }

        function extrageCuvinte(text) {
            var cuvinte = text.split("<br>");
            cuvinte.splice(cuvinte.length - 1,1);
            return cuvinte;
        }

        function citesteTarile() {
            var tari = [];

            fetch('citire_tari.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('A avut loc o eroare de rețea.');
                }
                return response.text();
            })
            .then(data => {
                tari = extrageCuvinte(data);

                var selectElement = document.getElementById("tara");

                for (var i = 0; i < tari.length; i++) {
                    var optionElement = document.createElement("option");
                    optionElement.textContent = tari[i];
                    optionElement.value = tari[i];

                    selectElement.appendChild(optionElement);
                }
            })
            .catch(error => {
                console.error('A apărut o eroare:', error);
            });
        }

        function citesteOrasele() {
            var orase = [];

            fetch('citire_orase.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('A avut loc o eroare de rețea.');
                }
                return response.text();
            })
            .then(data => {
                orase = extrageCuvinte(data);

                var selectElement = document.getElementById("oras");

                for (var i = 0; i < orase.length; i++) {
                    var optionElement = document.createElement("option");
                    optionElement.textContent = orase[i];
                    optionElement.value = orase[i];
                    selectElement.appendChild(optionElement);
                }
            })
            .catch(error => {
                console.error('A apărut o eroare:', error);
            });
        }

        function citesteUser() {
            email = localStorage.getItem('user');
            
            fetch('citire_user.php?email=' + email.toString())
            .then(response => {
                if (!response.ok) {
                    throw new Error('A avut loc o eroare de rețea.');
                }
                return response.text();
            })
            .then(data => {

                informatii = extrageCuvinte(data);

                var inputNume = document.getElementById("nume");
                inputNume.value = informatii[0];

                var inputPrenume = document.getElementById("prenume");
                inputPrenume.value = informatii[1];

                var functia = document.getElementById("functia");
                functia.value = informatii[2];

                var departament = document.getElementById("departament");
                departament.value = informatii[3];

                var tara = document.getElementById("tara"); 
                tara.value = informatii[4];

                var oras = document.getElementById("oras");
                oras.value = informatii[5];
            })
            .catch(error => {
                console.error('A apărut o eroare:', error);
            });
        }
  
        citesteUser();
        citesteTarile();
        citesteOrasele();
    </script>

</body>
</html>


