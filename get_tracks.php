<?php

function get_tracks($curl, $url) {
  //$final_track_list = array();
  global $final_track_list;
  // curl_setopt($curl, CURLOPT_HTTPHEADER, [
  //   'Accept: application/json',
  //   'X-EMAIL: api',
  //   'X-PASSWORD: $LY`pYv6\DxB+CgF'
  // ]);

  curl_setopt($curl,CURLOPT_URL,$url);
  curl_setopt($curl, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');

  $response = curl_exec($curl);
  $response = json_decode($response, true);
  $tracks = $response['collection'];
  print_r($tracks);
  foreach ($tracks as $track) {
    //print_r($track);
    $info = $track['track'];
    $t = array(
      'duration' => $info['duration'],
      'id' => $info['id'],
      'permalink' => $info['permalink'],
      'permalink_url' => $info['permalink_url'],
      'genre' => $info['genre'],
      'title' => $info['title'],
      'uri' => $info['uri'],
      'urn' => $info['urn'],
      'user_id' => $info['user_id'],
      'waveform_url' => $info['waveform_url'],
      'user' => $info['user']['username'],
      'user_url' => $info['user']['permalink_url']
    );
    print_r($t);
    array_push($final_track_list, $t);
  }
  $next_url = $response['next_href'];

  if($next_url) {
    $next_url = $next_url . "&client_id=jdhj09mFfEyGQTY6Y3vHmfHisv9NpPUD";
    $next_url = str_replace("limit=10", "limit=50", $next_url);
    $next_url = str_replace("limit=24", "limit=50", $next_url);
    print_r($next_url);
    get_tracks($curl, $next_url);
  }
  return $final_track_list;

}

?>
