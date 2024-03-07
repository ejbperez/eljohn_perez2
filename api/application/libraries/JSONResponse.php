<?php

class JSONResponse
{
    public static function json_output($data)
    {
        header('content-type: application/json');
        return json_encode($data);
    }
    public static function output($data)
    {	
        exit($data);
    }
}
?>
