<?php
// https://dev.to/tomox0115/php-get-information-about-a-specific-youtube-video-1k6b
require __DIR__.'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// ID of video
$video_id = "tL3-kd9zl_s";

// Return Duration
function getYoutubeVideo(string $video_id) {
    $api_key = $_ENV['PUBLIC_KEY_YOUTUBE'];

    $url = "https://www.googleapis.com/youtube/v3/videos?id=$video_id&key=$api_key&part=snippet,contentDetails,statistics,status";
    $getData = json_decode( file_get_contents($url), true);
    foreach($getData['items'] as $key => $gDat){
         return $gDat['contentDetails']['duration'];
    }
}

// return Seconds
 function duration($ytDuration) {
    $di = new DateInterval($ytDuration);
    
    $totalSec = 0;
    if ($di->h > 0) {
      $totalSec+=$di->h*3600;
    }
    if ($di->i > 0) {
      $totalSec+=$di->i*60;
    }
    $totalSec+=$di->s;
    
    return $totalSec;
  }

// return Timescamp
function convert_time($youtube_time) {
    preg_match_all('/(\d+)/',$youtube_time,$parts);

    // Put in zeros if we have less than 3 numbers.
    if (count($parts[0]) == 1) {
        array_unshift($parts[0], "0", "0");
    } elseif (count($parts[0]) == 2) {
        array_unshift($parts[0], "0");
    }

    $sec_init = $parts[0][2];
    $seconds = $sec_init%60;
    $seconds_overflow = floor($sec_init/60);

    $min_init = $parts[0][1] + $seconds_overflow;
    $minutes = ($min_init)%60;
    $minutes_overflow = floor(($min_init)/60);

    $hours = $parts[0][0] + $minutes_overflow;

    if($hours != 0)
        return $hours.':'.$minutes.':'.$seconds;
    else
        return $minutes.':'.$seconds;
}


$v = getYoutubeVideo($video_id);

var_dump($v."\n");
var_dump(duration($v)."\n");
// var_dumpconvert_time($v));
?>