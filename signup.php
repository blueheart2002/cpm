<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
    </style>
</head>
<body>

    <div class="container">
        <h1>Inregistrează-te</h1>
        <form id="signupForm" action="signup2.php" method="POST" onsubmit="return validateEmail()">
            <label for="name">Nume:</label>
            <input type="text" id="nume" name="nume" required><br><br>
            <label for="name">Prenume:</label>
            <input type="text" id="prenume" name="prenume" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="password">Parolă:</label>
            <input type="password" id="parola" name="parola" required><br><br>
            <label for="password">Confirmă Parola:</label>
            <input type="password" id="conf_parola" name="conf_parola" required><br><br>
            <input type="submit" value="Confirma Inregistrarea">
        </form>

        Aveti deja cont? <a href="login.php">Conectati-va!</a>
    </div>

    <script>
        function validateEmail() {
            var emailInput = document.getElementById("email");
            var email = emailInput.value.trim();
            var emailPattern = /@upt\.ro$/;

            if (!emailPattern.test(email)) {
                alert("Adresa de email trebuie să se termine cu '@upt.ro'.");
                emailInput.focus();
                return false;
            }

            var parolaInput = document.getElementById("parola");
            var parola = parolaInput.value.trim();
            var parolaConf = document.getElementById("conf_parola");
            var conf_parola = parolaConf.value.trim();

            if(parola != conf_parola) {
                alert("Parolele nu coincid!")
                return false;
            }

            fetch('confirmare_email.php?email=' + email.toString())
            .then(response => {
                if (!response.ok) {
                throw new Error('A avut loc o eroare de rețea.');
                }
                return response.text();
            })
            .then(data => {
                console.log('Răspunsul PHP:', data);
                if (data == "true") {
                    alert("Aceasta adresa de email este folosita deja!");
                    emailInput.focus();
                    return false;
                }
                else if(data == "false") {
                    localStorage.setItem("user", email);
                    document.getElementById("signupForm").submit();
                    return true;
                }
            })
            .catch(error => {
                console.error('A apărut o eroare:', error);
            });


            return false;
            
        }
    </script>
</body>
</html>
