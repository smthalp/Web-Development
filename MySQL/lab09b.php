<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab09b</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #eee6e6;
            margin: 0;
            padding: 0;
            color: #7a4a53;
        }
        h1 {
            text-align: center;
            background-color: #bea4a5;
            padding: 20px;
            margin: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #bea4a5;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #7a4a53;
            color: white;
        }
        td {
            background-color: #eee6e6;
        }
        tr:nth-child(even) td {
            background-color: white;
        }
        .photo {
            max-width: 150px;
            height: auto;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<h1>Photos In Database</h1>

<div class="container">
    <?php
    $host = "localhost";
    $database = "slopapa";
    $user = "slopapa";
    $password = "WM150BLD";

    $connect = mysqli_connect($host, $user, $password, $database) or die(mysqli_error($connect));

    $sql = "SELECT * FROM Photos ORDER BY date_taken DESC";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<thead><tr><th>Picture Number</th><th>Subject</th><th>Location</th><th>Date Taken</th><th>Picture</th></tr></thead><tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['picture_number'] . "</td>";
            echo "<td>" . $row['subject'] . "</td>";
            echo "<td>" . $row['location'] . "</td>";
            echo "<td>" . $row['date_taken'] . "</td>";
            // Display the image directly on the page
            echo "<td><img class='photo' src='" . $row['picture_url'] . "' alt='" . $row['subject'] . "' /></td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p>No records found.</p>";
    }

    mysqli_close($connect);
    ?>
</div>

</body>
</html>
