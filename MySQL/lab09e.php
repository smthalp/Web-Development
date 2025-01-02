<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Image and Image Count</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #eee6e6;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color: #7a4a53;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .photo-card {
            width: 300px;
            margin: 20px auto;
            border: 2px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .photo-card img {
            width: 100%;
            height: auto;
        }

        .photo-card .caption {
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            color: #333;
            background-color: #f9f9f9;
        }

        .image-count {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }

    </style>
</head>
<body>

<header>
    <h1>Random Image and Total Image Count</h1>
</header>

<div class="container">

    <?php
    // Database connection
    $host = "localhost";
    $database = "slopapa";
    $user = "slopapa";
    $password = "WM150BLD";
    $connect = mysqli_connect($host, $user, $password, $database) or die(mysqli_error($connect));

    // Fetch a random image from the Photos table
    $randomQuery = "SELECT * FROM Photos ORDER BY RAND() LIMIT 1";
    $randomResult = mysqli_query($connect, $randomQuery);

    if ($randomRow = mysqli_fetch_assoc($randomResult)) {
        // Display the random image and caption
        echo "<div class='photo-card'>";
        echo "<img src='" . $randomRow['picture_url'] . "' alt='" . $randomRow['subject'] . "'>";
        echo "<div class='caption'>" . $randomRow['subject'] . " - " . $randomRow['location'] . "</div>";
        echo "</div>";
    } else {
        echo "<p>No images found in the database.</p>";
    }

    // Get the total number of images in the database
    $countQuery = "SELECT COUNT(*) AS total FROM Photos";
    $countResult = mysqli_query($connect, $countQuery);
    $countRow = mysqli_fetch_assoc($countResult);
    $totalImages = $countRow['total'];

    echo "<div class='image-count'>Total number of images in the database: $totalImages</div>";

    // Close the database connection
    mysqli_close($connect);
    ?>

</div>

</body>
</html>
