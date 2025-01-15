<?php


function currency_format($number, $uit = 'đ'){
    return number_format($number).' '.$uit;
}

?>