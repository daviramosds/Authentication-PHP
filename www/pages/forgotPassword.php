<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_ENV['PROJECT_NAME'].' | '; ?> Forgot Password</title>
</head>

<body>
    <?php
    if (isset($_POST['form'])) {
        $email = $_POST['email'];

        if (!$email) {
            Alert::Error(('Empty data is now allowed'));
        } else {
          User::generateResetPasswordToken($email);
        }
    }

    ?>

    <section class="container">
        <div class="title">Password Recovery</div>

        <form method="post" class="password-recovery">
            <input type="email" name="email" placeholder="email">

            <input type="submit" name="form" value="Recover">
        </form>

    </section>


</body>

</html>