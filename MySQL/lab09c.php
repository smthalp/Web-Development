<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab09c</title>
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

        .photo-gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .photo-card {
            width: 250px;
            margin: 10px;
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
            border-bottom: 2px solid #ddd;
        }

        .photo-card .caption {
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            color: #333;
            background-color: #f9f9f9;
        }

        .no-photos {
            text-align: center;
            font-size: 18px;
            color: #ff4d4d;
            padding: 20px;
        }

    </style>
</head>
<body>

<header>
    <h1>Ontario Photos</h1>
</header>

<div class="container">
    <?php
    $host = "localhost";
    $database = "slopapa";
    $user = "slopapa";
    $password = "WM150BLD";

    // Establish connection
    $connect = mysqli_connect($host, $user, $password, $database) or die(mysqli_error($connect));

    // Query to fetch photos taken in Ontario
    $sql = "SELECT * FROM Photos WHERE location = 'Ontario' ORDER BY date_taken DESC";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='photo-gallery'>";

        // Display each photo
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='photo-card'>";
            echo "<img src='" . $row['picture_url'] . "' alt='" . $row['subject'] . "'>";
            echo "<div class='caption'>" . $row['subject'] . " - " . $row['location'] . "</div>";
            echo "</div>";
        }

        echo "</div>";
    } else {
        echo "<div class='no-photos'>There are no photos from Ontario.</div>";
    }

    // Close the database connection
    mysqli_close($connect);
    ?>
</div>

</body>
</html>
