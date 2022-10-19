<?php
if (!function_exists('dd')) {

    function dd($parm = null)
    {
        echo "<pre>";
        var_dump($parm);
        echo "</pre>";
    }
}
