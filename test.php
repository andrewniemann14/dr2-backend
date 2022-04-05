<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$queryParams = explode('?', $_SERVER['QUERY_STRING']);
$queries = array();
foreach ($queryParams as $q) {
  $pair = explode('=', $q);
  $queries[$pair[0]] = $pair[1];
}

print '<pre>';
print_r($queries);
print '</pre>';