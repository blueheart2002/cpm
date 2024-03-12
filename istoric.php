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
            <img src="pozamea.png" alt="" class="cover-photo">
        </a>
        <div class="navbar-nav">
            <a href="index.html" class="option">Acasa</a>
            <a href="myprofile.php" class="option">Profilul meu</a>
            <a href="istoric.php" class="selected-option">Istoric Meetinguri</a>
            <a href="signup.php" class="option">Deconectati-va</a>
        </div>
    </nav>

    <div class="container">
        <table id="meeting_table">
            <thead>
                <tr>
                    <th>Nume Meeting</th>
                    <th>Categorie</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <script>
        function citesteMeeting() {
            email = localStorage.getItem('user');
            
            fetch('citire_meeting.php?email=' + email.toString())
            .then(response => {
                if (!response.ok) {
                    throw new Error('A avut loc o eroare de rețea.');
                }
                return response.text();
            })
            .then(data => {

                informatii = extrageCuvinte(data);

                informatii.forEach(element => {
                    meeting = element.split(",");
                    
                    addMeetingRow(meeting[0], meeting[1]);
                });

                // var numeMeeting = document.getElementById("nume_meeting");
                // numeMeeting.innerText = informatii[0];

                // var categorieMeeting = document.getElementById("categorie_meeting");
                // categorieMeeting.innerText = informatii[1];

            })
            .catch(error => {
                console.error('A apărut o eroare:', error);
            });
        }

        function extrageCuvinte(text) {
            var cuvinte = text.split("<br>");
            cuvinte.splice(cuvinte.length - 1,1);
            return cuvinte;
        }

        function addMeetingRow(nume, categorie) {
            var table = document.getElementById("meeting_table").getElementsByTagName('tbody')[0];
            var newRow = table.insertRow(table.rows.length);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            cell1.innerHTML = nume;
            cell2.innerHTML = categorie;
        }

        citesteMeeting();
    </script>

</body>
</html>


