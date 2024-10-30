<?php
// fetch_album.php

// Include the API credentials
require_once 'config.php';

// Step 1: Get an access token
function getSpotifyAccessToken($clientId, $clientSecret) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Basic ' . base64_encode("$clientId:$clientSecret"),
        'Content-Type: application/x-www-form-urlencoded'
    ]);
    $response = curl_exec($ch);
    $token = json_decode($response)->access_token;
    curl_close($ch);

    return $token;
}

// Step 2: Use the access token to get album data
function fetchAlbumData($albumId, $accessToken) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/albums/$albumId");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $accessToken
    ]);
    $albumResponse = curl_exec($ch);
    curl_close($ch);

    return json_decode($albumResponse);
}

// Example usage
$albumId = '4LH4d3cOWNNsVw41Gqt2kv'; // Replace with dynamic ID as needed
$accessToken = getSpotifyAccessToken($clientId, $clientSecret);
$albumData = fetchAlbumData($albumId, $accessToken);

// Output album data for testing
//echo "<h1>{$albumData->name}</h1>";
//echo "<p>Artist: {$albumData->artists[0]->name}</p>";
//echo "<p>Release Date: {$albumData->release_date}</p>";
//echo "<img src='{$albumData->images[0]->url}' alt='Album Cover'>";
//foreach ($albumData->tracks->items as $track) {
//    echo "<p>Track: {$track->name}</p>";
//}
?>
