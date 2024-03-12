<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
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
        <h1>Conectează-te</h1>
        <form id="loginForm" action="" method="POST" onsubmit="return validateCredentials()">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="password">Parolă:</label>
            <input type="password" id="parola" name="parola" required><br><br>
            <input type="submit" value="Conecteza-te">
        </form>

        Nu aveti deja cont? <a href="signup.php">Inregistrati-va!</a>
    </div>

    <script>
        function validateCredentials() {
            var emailInput = document.getElementById("email");
            var email = emailInput.value.trim();

            var parolaInput = document.getElementById("parola");
            var parola = parolaInput.value.trim();

            console.log('confirmare_login.php?email=' + email.toString() + '&parola=' + parola.toString())

            fetch('confirmare_login.php?email=' + email.toString() + '&parola=' + parola.toString())
            .then(response => {
                if (!response.ok) {
                throw new Error('A avut loc o eroare de rețea.');
                }
                return response.text();
            })
            .then(data => {
                console.log('Răspunsul PHP:', data);
                if (data == "exista") {
                    localStorage.setItem("user", email);
                    document.getElementById("loginForm").submit();
                    document.location.href = "index.html";
                    return true;
                }
                else if(data == "nu_exista") {
                    alert("Email-ul sau parola sunt gresite!");
                    return false;
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
