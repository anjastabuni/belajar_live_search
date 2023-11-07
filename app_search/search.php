<?php
// Simulasikan pencarian
$query = $_POST['query'];

// Anda dapat mengganti ini dengan logika pencarian yang sesuai dengan kebutuhan Anda
$results = array();

include_once "kosakata.php";

if (empty($results)) {
    echo "Tidak ada hasil ditemukan.";
} else {
    foreach ($results as $result) {
        echo "$result <br>";
    }
}
