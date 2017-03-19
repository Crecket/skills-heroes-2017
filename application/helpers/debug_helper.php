<?php

function debug($var, $die = false)
{
    echo "<pre>";
    print_r($var);
    echo "<hr />";
    echo "</pre>";
    if ($die) {
        die();
    }
}