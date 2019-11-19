<?php

function plus56 ($date){

  $temp= clone $date;
  date_add($temp, date_interval_create_from_date_string('56 days'));
  return date_format($temp, 'd-m-Y');}

function plus28 ($date){

  $temp= clone ($date);
  date_add($temp, date_interval_create_from_date_string('28 days'));
    return date_format($temp, 'd-m-Y');}

function plus14 ($date){

  $temp= clone ($date);
     date_add($temp, date_interval_create_from_date_string('14 days'));
    return date_format($temp, 'd-m-Y');}

 ?>
