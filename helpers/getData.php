<?php
declare(strict_types = 1);

function getData(string $route): mixed {
    $data = file_get_contents($route);
    
    if (!$data) return false;

    return json_decode($data);    
}