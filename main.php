<?php
include 'get_tracks.php';
include 'insert_tracks.php';

//Connect to database
// $mysqli = connect_to_db();
$pdo = db_connect();

//Set up cURL session
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_COOKIESESSION, true);
curl_setopt($curl, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
curl_setopt($curl, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');


//API Endpoint URL
//$url = "https://api-v2.soundcloud.com/users/10270754/track_likes?client_id=TaTmd2ARXgnp20a7BQJwuZ8xGFbrYgz5";
$url = "https://api-v2.soundcloud.com/stream/users/10270754?client_id=jdhj09mFfEyGQTY6Y3vHmfHisv9NpPUD&limit=20&offset=0&linked_partitioning=1&app_version=1612537171&app_locale=en";

//$tracks = get_tracks($curl, $url);
$final_track_list = array();
get_tracks($curl, $url);
print_r($final_track_list);

foreach ($final_track_list as $track) {
  insert_tracks($track, $pdo);
  print_r($track);
}
// file_put_contents("soundcloud_results.csv", $final_track_list);
//
// function cleanData($str) {
//   $str = preg_replace("/\t/", "\\t", $str);
//   $str = preg_replace("/\r?\n/", "\\n", $str);
// }
//
// $filename = "soundcloud";
// $file_ending = "xls";
// //header info for browser
// header("Content-Type: application/xls");
// header("Content-Disposition: attachment; filename=$filename.xls");
// header("Pragma: no-cache");
// header("Expires: 0");
//
// for ($final_track_list as $row) {
// echo mysql_field_name($result,$i) . "\t";
// }
// print("\n");
// //end of printing column names
// //start while loop to get data
//     while($row = mysql_fetch_row($result))
//     {
//         $schema_insert = "";
//         for($j=0; $j<mysql_num_fields($result);$j++)
//         {
//             if(!isset($row[$j]))
//                 $schema_insert .= "NULL".$sep;
//             elseif ($row[$j] != "")
//                 $schema_insert .= "$row[$j]".$sep;
//             else
//                 $schema_insert .= "".$sep;
//         }
//         $schema_insert = str_replace($sep."$", "", $schema_insert);
//         $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
//         $schema_insert .= "\t";
//         print(trim($schema_insert));
//         print "\n";
//     }
//
//
// // foreach ($sites as $site) {
// //   $site = str_replace('-', '_', $site);
// //   $res = $mysqli -> query("USE " . $site . "_prod;");
// //   //print_r($site);
// //   $site = str_replace('_', '-', $site);
// //
// //   if ($res != 1) {
// //     echo "Error Connecting to : " . $site . " db\n";
// //   }
// //
// //   $sql_data = get_data($mysqli, $sql, $site);
// //   print_r($sql_data);
// //   foreach ($sql_data as $row) {
// //
// //     $facility = array(
// //       "6" => array("value" => $row['name']),
// //       "7" => array("value" => $row['address_line1']),
// //       "8" => array("value" => $row['address_line2']),
// //       "9" => array("value" => $row['city']),
// //       "10" => array("value" => $row['state']),
// //       "11" => array("value" => $row['postal_code']),
// //       "13" => array("value" => $site),
// //       "17" => array("value" => $site . '_' . $row['id'])
// //     );
// //     $postData = array(
// //         'to' => 'bq68bqt5k',
// //         'data' => array($facility),
// //         'mergeFieldId' => 17,
// //         'fieldsToReturn' => array()
// //     );
// //     print_r($postData);
// //     quickbase_post($url, $postData, $curl);
// //   }
// // }

?>
