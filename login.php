<?php
$errorMessage = '';

if (isset($_GET['Err'])) {
    $errorMessage = 'Wrong e-mail or password';
}
?>
<html>
<head>
    <title>Pilot login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Flight Training Logbook</h1>
        <h2>Pilot login</h2>

        <div class="message"><?php echo htmlspecialchars($errorMessage); ?></div>

        <form method="post" action="login_action.php">
            <fieldset>
                <legend>Account</legend>

                <label>E-mail</label>
                <input type="text" name="email">
                <br>

                <label>Password</label>
                <input type="password" name="password">
                <br>

                <input type="submit" value="Login">
            </fieldset>
        </form>

        <p><a href="register.php">Create a new account</a></p>
    </div>
</body>
</html>
