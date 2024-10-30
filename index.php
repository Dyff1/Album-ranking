<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rank Albums</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

<table width="1500" height="1320" border="1" class="table1">
    <tbody>
        <tr>
            <!-- Page Header and Search Form -->
            <th height="100" colspan="1" scope="col">
                <h1>Rank Albums</h1>
                <div class="form-container">
                    <form action="index.php" method="GET">
                        <label for="albumId">Enter Album ID:</label>
                        <input type="text" name="albumId" id="albumId">
                        <button type="submit">Fetch Album</button>
                    </form>
                </div>
            </th>
        </tr>

        <tr>
            <th height="273" colspan="1" scope="col">
                <table width="1058" border="0" class="sisa-table">
                    <tbody>
                        <tr>
                            <td width="294" height="100" align="center" valign="middle">
                                <!-- Album Data Display Section -->
                                <?php
                                require_once 'fetch_album.php';

                                // Check if the album ID was provided and fetch album data
                                if (isset($_GET['albumId'])) {
                                    $albumId = htmlspecialchars($_GET['albumId']);
                                    $accessToken = getSpotifyAccessToken($clientId, $clientSecret);
                                    $albumData = fetchAlbumData($albumId, $accessToken);

                                    // Display the album data if available
                                    if ($albumData) {
                                        echo "<h2>{$albumData->name}</h2>";
                                        echo "<p>Artist: {$albumData->artists[0]->name}</p>";
                                        echo "<p>Release Date: {$albumData->release_date}</p>";
                                        echo "<img src='{$albumData->images[0]->url}' alt='Album Cover' width='300' height='300'>";
                                        echo "<h3>Track List:</h3><ul>";
                                        foreach ($albumData->tracks->items as $track) {
                                            echo "<li>{$track->name}</li>";
                                        }
                                        echo "</ul>";
                                    } else {
                                        echo "<p>Album not found. Please check the ID.</p>";
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </th>
        </tr>
    </tbody>
</table>

<!-- Footer Section -->
<table width="1500" height="214" border="0" class="bottom">
    <tbody>
        <tr>
            <td height="208">
                <!-- Footer content (if any) -->
            </td>
        </tr>
    </tbody>
</table>

</body>
</html>
