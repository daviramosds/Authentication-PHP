<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_ENV['PROJECT_NAME'].' | '; ?> Register</title>
</head>

<body>

    <?php
    if (isset($_POST['form'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $verifyPassword = $_POST['verify_password'];

        if (!$username || !$email || !$password || !$verifyPassword) {
            Alert::error(('Empty data is now allowed'));
        } else if ($password != $verifyPassword) {
            Alert::error(('Passwords dont match'));
        } else {
            User::register($username, $email, $password);
        }
    }

    ?>




    <section class="container">
        <div class="title">Register or <a href="/login">Login</a></div>

        <form method="post">
            <input type="text" name="username" placeholder="username">
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <input type="password" name="verify_password" placeholder="verify password">

            <input type="submit" name="form" value="Register">
        </form>

    </section>


</body>

</html>