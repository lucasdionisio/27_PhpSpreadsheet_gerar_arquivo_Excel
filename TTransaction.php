<?php
class TTransaction
{
    private static $conn;

    public static function open($database)
    {
        if ($database == 'app') {
            self::$conn = new PDO('mysql:host=localhost;dbname=app', 'root', '');
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    public static function get()
    {
        return self::$conn;
    }

    public static function close()
    {
        self::$conn = null;
    }
}
?>
