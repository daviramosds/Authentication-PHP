<?php
class User
{
    public static function logged()
    {
        if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
            return true;
        } else if (isset($_COOKIE['data'])) {

            $decryption = openssl_decrypt(
                $_COOKIE['data'],
                $_ENV['CIPHER'],
                $_ENV['ENCRYPTION_KEY'],
                $_ENV['OPTIONS'],
                $_ENV['ENCRYPTION_IV']
            );

            $decryption = json_decode($decryption, true);

            $_SESSION['username'] = $decryption['username'];
            $_SESSION['email'] = $decryption['email'];

            return true;
        } else {
            return false;
        }
    }

    public static function register($username, $email, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $db = Database::connect()->prepare("SELECT COUNT(*) as count FROM `users` WHERE `email`= ?");
        $db->execute(array($email));
        $db = $db->fetch();

        if ($db['count'] == 1) {
            Alert::error('This email already exist');
        } else {
            $db = Database::connect()->prepare("INSERT INTO `users` VALUES (null, ?, ?, ?, NULL, NULL)");
            if ($db->execute(array($username, $email, $password))) {
                Alert::success('Account created');
            } else {
                Alert::error('Something went wrong');
            }
        }
        return true;
    }

    public static function login($email, $password, $remember = false)
    {
        $db = Database::connect()->prepare("SELECT * FROM `users` WHERE `email` = ?");
        $db->execute([$email]);

        $db = $db->fetch();

        if (!$db) {
            Alert::error('Wrong data');
        } else {
            if (password_verify($password, $db['password'])) {

                if ($remember) {

                    $data = [
                        'username' => $db['username'],
                        'email' => $db['email'],
                    ];

                    $data =  json_encode($data);

                    $encryption = openssl_encrypt(
                        $data,
                        $_ENV['CIPHER'],
                        $_ENV['ENCRYPTION_KEY'],
                        $_ENV['OPTIONS'],
                        $_ENV['ENCRYPTION_IV']
                    );

                    @setcookie('data', $encryption, (time() + (60 * 60 * 24)), '/', null, true, true);

                    $_SESSION['username'] = $db['username'];
                    $_SESSION['email'] = $email;
                } else {
                    $_SESSION['username'] = $db['username'];
                    $_SESSION['email'] = $email;
                }


                Website::redirect('/');
            } else {
                Alert::error('Wrong data');
            }
        }
    }

    public static function generateResetPasswordToken($email)
    {
        $db = Database::connect()->prepare("SELECT * FROM `users` WHERE `email` = ?");
        $db->execute([$email]);

        $db = $db->fetch();

        if ($db) {
            $resetPasswordToken = bin2hex(openssl_random_pseudo_bytes(8));

            $resetPasswordTokenExpires = date("Y-M-d H:m", strtotime('now +1 hour'));

            $db = Database::connect()->prepare("UPDATE `users` SET `resetPasswordToken` = ?, `resetPasswordTokenExpires` = ? WHERE `email` = ?");
            $db->execute([$resetPasswordToken, $resetPasswordTokenExpires, $email]);

            Email::sendResetEmail($email, $_ENV['INCLUDE_PATH'] . 'password/reset?token=' . $resetPasswordToken);
        }

        Alert::success('If you have a account we will send a email to reset the password');
    }

    public static function passwordReset($token, $password)
    {

        $db = Database::connect()->prepare("SELECT * FROM `users` WHERE `resetPasswordToken` = ?");
        $db->execute([$token]);

        $db = $db->fetch();

        if ($db) {

            $now = date("Y-M-d H:m");

            if ($now >= $db['resetPasswordTokenExpires']) {
                Alert::error('This token is invalid, please try again');
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);

                $db = Database::connect()->prepare("UPDATE `users` SET `password` = ?, `resetPasswordToken` = ?, `resetPasswordTokenExpires` = ? WHERE `resetPasswordToken` = ?");

                $db->execute([$password, null, null, $token]);

                Alert::success('Done, you can login now');
            }
        } else {
            Alert::error('Invalid token');
        }
    }

    public static function logout()
    {
        @setcookie('data', false, (time() - 1), '/');
        session_destroy();
        Website::Redirect('/');
    }
}
