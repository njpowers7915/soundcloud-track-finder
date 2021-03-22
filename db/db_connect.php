<?php
function db_connect() {
    $mysqli = new mysqli(
        $_ENV['DB_HOST'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASSWORD'],
        $dbname = "soundcloud"
    );
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    echo $mysqli->host_info . "\n";
    return $mysqli;
}

function db_close($conn) {
    $conn -> close();
}