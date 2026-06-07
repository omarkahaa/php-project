<?php
$errorMessage = '';

if (isset($_GET['Err'])) {
    $errorMessage = 'Please complete the form correctly';
}

if (isset($_GET['Exists'])) {
    $errorMessage = 'This e-mail is already used';
}
?>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Create account</h1>
        <div class="message"><?php echo htmlspecialchars($errorMessage); ?></div>

        <form method="post" action="register_action.php">
            <fieldset>
                <legend>Pilot information</legend>

                <label>First name</label>
                <input type="text" name="first_name">
                <br>

                <label>Last name</label>
                <input type="text" name="last_name">
                <br>

                <label>E-mail</label>
                <input type="text" name="email">
                <br>

                <label>Password</label>
                <input type="password" name="password">
                <br>

                <input type="submit" value="Register">
                <a href="login.php">Back to login</a>
            </fieldset>
        </form>
    </div>
</body>
</html>
