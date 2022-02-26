<?php
    class Database {
        private static $pdo;
        public static function connect() {
            if(self::$pdo == null) {
                try{
                    $host = 'localhost:3306';
                    $db = 'datab';
                    // self::$pdo = new PDO("mysql:host=$host;dbname=$db", 'root', '');
                    self::$pdo = new PDO('sqlite:db.sqlite');
                    self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                }catch(Exception $e){
                    echo '<h2>Cant connect</h2> error: '.$e;
                }
            }

            return self::$pdo;
        }
    }

?>