<?php

$conn = new mysqli('localhost', 'root', '', 'newsletter');

if($conn->connect_errno) {
    echo "Ha ocurrido un error al conectarse a la base de datos (" . $conn->connect_errno . ")";
}

$conn->set_charset('utf8');