<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('replacher')){
    function replacher(&$item, $key)
    {
        
        if ($item === 'null') {
        $item = "";
    }
     if ($item === false) {
        $item = "";
    }
        $item = utf8_encode($item);
    }
}
?>
