<?php
class clsketnoi
{

    function ketnoiDB()
    {
        $connect =  mysqli_connect('localhost', 'root', '', 'onekill');
        mysqli_set_charset($connect, "utf8");
        return $connect;
    }
    function dongketnoi($connect)
    {
        mysqli_close($connect);
    }
}




