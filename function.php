<?php

#Functions for printing out array better look

function show($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

/**
 * Variable a and varriable b is rectange sides
 * Vriable
 * Calculate rectangle area
 */

function area($a, $b) {
    return $a * $b;
}

/**
 * Function returns True or False
 */

function isMen($gender){
    if(strtolower($gender) == 'm'){
        return true;
    } else {
        return false;
    }
}

/**
 * Writing rows to session
 */

function setRows($rows){
    $_SESSION['rows'] = $rows;
}

/**
 * Geting session info
 */

function getRows(){
    return $_SESSION['rows'];
}

/**
 * Sorting elements how we do it
 */

 function getWhat(){
     return $_SESSION['what'];
 }

 /**
  * How to sort 
  */

function getOrder() {
    return $_SESSION['order'];
}




?>