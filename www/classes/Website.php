<?php
    class Website {
        public static function redirect($url) {
            echo '<script>location.href="'.$url.'"</script>';
            die();
        }
    }
?>