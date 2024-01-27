<?php
require_once('config.php');

$error = array(
    'firstname' => '',
    'lastname' => '',
    'username' => '',
    'email' => '',
    'password' => ''
);

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $firstname = $connessione->real_escape_string($_POST['firstname']);
    $lastname = $connessione->real_escape_string($_POST['lastname']);
    $username = $connessione->real_escape_string($_POST['username']);
    $email = $connessione->real_escape_string($_POST['email']);
    $password = $connessione->real_escape_string($_POST['password']);

    if (strlen($password) < 8 || !preg_match("/[0-9]+/", $password) || !preg_match("/[A-Z]+/", $password) || !preg_match("/[^\w]+/", $password)) {
        $error['password'] = "La password deve contenere almeno 8 caratteri, numeri, simboli e una lettera maiuscola.";
    }

    if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password)) {
        $error['registration'] = "Compilare tutti i campi obbligatori.";
    } else {
        $email_valid = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email_valid) {
            $error['email'] = "L'indirizzo email inserito non è valido.";
        } else {
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = $connessione->query($sql);
            if ($result->num_rows > 0) {
                $error['email'] = "L'indirizzo email inserito è già registrato.";
            } else {
                $query = "SELECT * FROM users WHERE username='$username'";
                $result = $connessione->query($query);
                if ($result->num_rows > 0) {
                    $error['username'] = "L'username esiste già.";
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users (firstname, lastname, username, email, password) VALUES ('$firstname', '$lastname', '$username', '$email', '$hashed_password')";
                    if ($connessione->query($sql) == true) {
                        header("Location: verifica-account.php?success=Registrazione avvenuta con successo."); // Redirect to login page with success message
                        exit();
                    } else {
                        $error['registration'] = "Errore durante la registrazione dell'utente $sql. " . $connessione->error;
                    }
                }
            }
        }
    }
} else {
    $error['registration'] = "Errore: campi obbligatori mancanti."; 
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Cyberlink dashboard</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <div class="caixa__login">
        <h2>Register</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="caixa__login-input">
                <input type="text" name="firstname" id="firstname" required value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : ''; ?>">
                <label for="firstname">Firstname</label>
                <?php if (!empty($error['firstname'])) { echo "<span class='error'>".$error['firstname']."</span>"; } ?>
            </div>
            <div class="caixa__login-input">
                <input type="text" name="lastname" id="lastname" required value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : ''; ?>">
                <label for="lastname">Lastname</label>
                <?php if (!empty($error['lastname'])) { echo "<span class='error'>".$error['lastname']."</span>"; } ?>
            </div>
            <div class="caixa__login-input">
                <input type="text" name="username" id="username" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                <label for="username">Username</label>
                <?php if (!empty($error['username'])) { echo "<span class='error'>".$error['username']."</span>"; } ?>
            </div>
            <div class="caixa__login-input">
                <input type="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                <label>Email</label>
                <?php if (!empty($error['email'])) { echo "<span class='error'>".$error['email']."</span>"; } ?>
            </div>
            <div class="caixa__login-input">
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
                <?php if (!empty($error['password'])) { echo "<span class='error'>".$error['password']."</span>"; } ?>
            </div>

            <div class="caixa__login-buttons">
                <a href="loginform.php">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Sign in
                </a>
                <a onclick="event.preventDefault(); document.querySelector('form').submit();">
                    <span></span>
                    <span></span>
                    <span></span>
                    Register
                </a>
            </div>
            <script>
                document.querySelectorAll('.caixa__login-input input').forEach(function(input) {
                    input.addEventListener('input', function() {
                        this.parentNode.querySelector('.error').innerHTML = '';
                    });
                });
            </script>
        </form>
    </div>  
</body>

</html>
