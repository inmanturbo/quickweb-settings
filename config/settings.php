<?php
$data =  file_get_contents(__DIR__ . '/settings.txt');
$vars = [];

$data = explode("\n", $data);
foreach ($data as &$row) {
    $row = explode('=', $row);
    $vars = array_key_exists(1, $row) ? array_merge($vars, [$row[0] => trim($row[1], '"')]) : [];
}


return array_filter($vars);
