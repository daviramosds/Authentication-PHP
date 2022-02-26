<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_ENV['PROJECT_NAME'].' | '; ?> Reset Password</title>
</head>

<body>


    <?php
    if (isset($_POST['form'])) {

        $token = $_POST['token'];
        $password = $_POST['password'];
        $verifyPassword = $_POST['verify_password'];

        if (!$token || !$password || !$verifyPassword) {
            Alert::error(('Empty data is now allowed'));
        } else if ($password != $verifyPassword) {
            Alert::error(('Passwords dont match'));
        } else {
            User::passwordReset($token, $password);
        }
    }

    ?>

    <section class="container">
        <div class="title">Password Recovery</div>

        <form method="post" class="reset_password">
            <input type="text" name="token" placeholder="token" value="<?php echo @$_GET['token'] ?>">
            <input type="password" name="password" placeholder="new password">
            <input type="password" name="verify_password" placeholder="verify new password">

            <input type="submit" name="form" value="Change">
        </form>

    </section>


</body>

</html>