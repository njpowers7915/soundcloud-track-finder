<?php
$servername = "127.0.0.1";
$username = "root";
$password = "BBCrad101";
$dbname = "soundcloud";
// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $dbname);
// // Check connection
// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }

function db_connect() {
  $pdo = new \PDO("mysql:host=127.0.0.1;dbname=soundcloud", 'root', 'BBCrad101', [
      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
      \PDO::ATTR_EMULATE_PREPARES => false
  ]);
  return $pdo;
}

function insert_tracks($track, $pdo) {
  $pdo->beginTransaction();
  $stmt = $pdo->prepare("INSERT
      INTO tracks (title,track_id,permalink,permalink_url,user,user_url,user_id,duration,genre,uri,urn,waveform_url,source,method)
      VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
  $stmt->execute([
    $track['title'],
    $track['id'],
    $track['permalink'],
    $track['permalink_url'],
    $track['user'],
    $track['user_url'],
    $track['user_id'],
    $track['duration'],
    $track['genre'],
    $track['uri'],
    $track['urn'],
    $track['waveform_url'],
    'SoundCloud',
    'REPOST'
  ]);
  $pdo->commit();
}


// mysqli_close($conn);
