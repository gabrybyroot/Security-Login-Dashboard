<?php
if (isset($_GET['success'])) {
    $successMsg = $_GET['success'];
    echo "<div class='message'>$successMsg</div>";
}

if (isset($_POST["submit"])) {
    $captcha = $_POST["g-recaptcha-response"];
    $secretKey = "";
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKey = json_decode($response, TRUE);
    
    if (!$responseKey["success"]) {
        $captchaError = "Completa il reCAPTCHA.";
    } else {
    }
}
?>

<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="A-UACompatile" content="IE=edge">
    <meta name="viewport" content="width=service-width, initial-scale=1.0">
    <title>Cyberlink Login</title>
    <link rel="stylesheet" href="cssstyle.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
</head>

<body>
    <div class="caixa__login">
        <h2>Login Dashboard</h2>
        <form action="login.php" method="POST" autocomplete="off">
            <div class="caixa__login-input">
                <input type="text" name="username" id="username" id="username" required>
                <label for="username">Username</label>
            </div>
            <div class="caixa__login-input">
                <input type="password" name="password" id="password"required>
                <label for="password">password</label>
                <a class="recovery-link" href="reset.php">Recover your password</a>


            </div>
            <a onclick="event.preventDefault(); if (grecaptcha.getResponse() == '') { document.querySelector('.message2').innerHTML = 'Completa il reCAPTCHA.'; } else { document.querySelector('form').submit(); }">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Login
            </a>
            <a href="index.php">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Register
            </a>
            <div class="g-recaptcha" data-sitekey=""></div>
            <br/>
            <div class="message2"><?php if (isset($captchaError)) { echo $captchaError; } ?></div>
            <?php if (isset($_GET['error'])) { ?>
                <div class="error-message"><?php echo $_GET['error']; ?></div>
            <?php } ?>

        </form>
    </div>
</body>
</html>
