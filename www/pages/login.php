<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_ENV['PROJECT_NAME'].' | '; ?> Login</title>
</head>

<body>


    <?php
    if (isset($_POST['form'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!$email || !$password) {
            Alert::Error(('Empty data is not allowed'));
        } else {
            if (isset($_POST['remember'])) {
                User::login($email, $password, true);
            } else {
                User::login($email, $password);
            }
        }
    }

    ?>

    <section class="container">
        <div class="title">Login or <a href="/register">Register</a></div>

        <form method="post" class="login">
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">

            <div class="remember">
                <input type="checkbox" name="remember">
                <label>Remember me</label>

            </div>

            <input type="submit" name="form" value="Login">
        </form>

        <p class="forgot-password">Forgot the password? <a href="/password/forgot">Password Recovery</a></p>

    </section>


</body>

</html>
