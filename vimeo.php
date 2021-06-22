<?php
require __DIR__.'/vendor/autoload.php';
use Vimeo\Vimeo;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Access to vimeo api
$client_id = $_ENV['VIMEO_CLIENT_ID'];
$client_secret = $_ENV['VIMEO_CLIENT_SECRET'];
$access_token = $_ENV['VIMEO_TOKEN'];

// ID of video (owners or public)
$video_id = "499714515";

$client = new Vimeo($client_id, $client_secret, $access_token);

// Request to find owner video (for the public use /video/$video_id)
$response = $client->request("/videos/$video_id");
var_dump($response["body"]['duration']);
?>