<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_ENV['PROJECT_NAME']. ' | '; ?> Home</title>
</head>

<body>
    <div class="container">
        <label>username: <span><?php echo $_SESSION['username']; ?></span></label>
        <label>email: <span><?php echo $_SESSION['email']; ?></span></label>
        <a href="/logout" class="logout">logout</a>
    </div>
</body>

</html>