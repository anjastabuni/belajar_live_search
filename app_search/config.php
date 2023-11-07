<?php
$q = intval($_POST['cari']);

$con = mysqli_connect('localhost', 'root', '', 'search_data');
if (!$con) {
    die('Could not connect: ');
}


