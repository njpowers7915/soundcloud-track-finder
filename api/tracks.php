<?php

require '../db/db_connect.php';

$con = db_connect();

//This retrieves the request method sent from the Axios client
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

switch ($method) {
    case 'GET':
        //$id = $_GET['id'];
        //$sql = "select * from tracks".($id?" where id=$id":'');
        $sql = "select * from tracks";
        break;
    case 'POST':
        $title = $_POST["title"];
        $track_id = $_POST["track_id"];
        $permalink = $_POST["permalink"];
        $permalink_url = $_POST["permalink_url"];
        $user = $_POST["user"];
        $user_url = $_POST["user_url"];
        $duration = $_POST["duration"];
        $genre = $_POST["genre"];
        $uri = $_POST["uri"];
        $urn = $_POST["urn"];
        $waveform_url = $_POST["waveform_url"];

        $sql = "UPDATE tracks SET genre = '$genre' WHERE track_id = '$track_id';";
        break;
}

// run SQL statement
$result = $con -> query($sql);
print_r($result);

// die if SQL statement failed
if (!$result) {
    http_response_code(404);
    die(mysqli_error($con));
}

//json_encode() is used to encode data as JSON and send it to client
if ($method == 'GET') {
    //if (!$id) echo '[';
    for ($i=0 ; $i<mysqli_num_rows($result) ; $i++) {
        echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
    }
    //if (!$id) echo ']';
} elseif ($method == 'POST') {
    echo json_encode($result);
} else {
    echo mysqli_affected_rows($con);
}

db_close($con);