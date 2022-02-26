<?php
class Alert
{
    public static function success($text)
    {
        echo
        "<script>
                Swal.fire({
                    title: 'Done!',
                    text: '$text',
                    icon: 'success',
                    showConfirmButton: true,
                });
            </script>";
    }

    public static function error($text)
    {
        echo
        "<script>
                Swal.fire({
                    title: 'Ops!',
                    text: '$text',
                    icon: 'error',
                    showConfirmButton: true,
                });
            </script>";
    }
}
