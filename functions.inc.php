<?php

function pr($str) {

    echo '<pre>';
    print_r($arr);
}

// when we have to check the status of array then this function called

function prx($arr) {

    echo '<pre>';
    print_r($arr);
}

function get_safe_value($conn,$str) {

    // if we have to update some thing so we can update in this function
    if($str!=''){
        // it remove space 
        $str=trim($str);
        return mysqli_real_escape_string($conn,$str);
        }
}
?>