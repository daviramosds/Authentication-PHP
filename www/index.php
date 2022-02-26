<?php include('config.php') ?>

<!-- SWEET ALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
<!-- GOOGLE FONTS -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,900&display=swap" rel="stylesheet">
<!-- STYLE -->
<link rel="stylesheet" href="<?php echo $_ENV['INCLUDE_PATH']; ?>style.css">

<?php

$page = @$_GET['url'] ? $_GET['url'] : 'home';

switch ($page) {
    case 'home':
        if (User::logged()) include('pages/home.php');
        else include('pages/login.php');
        break;

    case 'login':
        include('pages/login.php');
        break;

    case 'register':
        include('pages/register.php');
        break;

    case 'logout':
        User::logout();
        break;

    case 'password/forgot':
        include('pages/forgotPassword.php');
        break;

    case 'password/reset':
        include('pages/resetPassword.php');
        break;


    default:
        Website::redirect('/');
        break;
}

?>