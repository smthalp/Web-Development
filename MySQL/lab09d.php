<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab09d</title>
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

        .form-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-container select, .form-container input {
            padding: 10px;
            font-size: 16px;
            margin: 10px;
            width: 200px;
        }

        .form-container input[type="submit"] {
            background-color: #7a4a53;
            color: white;
            border: none;
            cursor: pointer;
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
    <h1>Filter Photos</h1>
</header>

<div class="container">
    <div class="form-container">
        <form action="" method="GET">
            <!-- Location Combo Box -->
            <label for="location">Choose Location:</label>
            <select name="location" id="location">
                <option value="">Select Location</option>
                <?php
                // MySQL connection
                $host = "localhost";
                $database = "slopapa";
                $user = "slopapa";
                $password = "WM150BLD";
                $connect = mysqli_connect($host, $user, $password, $database) or die(mysqli_error($connect));

                // Fetch distinct locations from the database
                $locationQuery = "SELECT DISTINCT location FROM Photos";
                $locationResult = mysqli_query($connect, $locationQuery);
                while ($row = mysqli_fetch_assoc($locationResult)) {
                    echo "<option value='" . $row['location'] . "'>" . $row['location'] . "</option>";
                }

                ?>
            </select>

            <!-- Year Combo Box -->
            <label for="year">Choose Year:</label>
            <select name="year" id="year">
                <option value="">Select Year</option>
                <?php
                // Fetch distinct years from the database
                $yearQuery = "SELECT DISTINCT YEAR(date_taken) AS year FROM Photos ORDER BY year DESC";
                $yearResult = mysqli_query($connect, $yearQuery);
                while ($row = mysqli_fetch_assoc($yearResult)) {
                    echo "<option value='" . $row['year'] . "'>" . $row['year'] . "</option>";
                }

                // Close the connection
                mysqli_close($connect);
                ?>
            </select>

            <input type="submit" value="Search">
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && (isset($_GET['location']) || isset($_GET['year']))) {
        // Reconnect to database
        $connect = mysqli_connect($host, $user, $password, $database) or die(mysqli_error($connect));

        // Get filter values
        $location = $_GET['location'];
        $year = $_GET['year'];

        // Construct the SQL query based on filters
        $sql = "SELECT * FROM Photos WHERE 1";

        if (!empty($location)) {
            $sql .= " AND location = '" . mysqli_real_escape_string($connect, $location) . "'";
        }

        if (!empty($year)) {
            $sql .= " AND YEAR(date_taken) = '" . mysqli_real_escape_string($connect, $year) . "'";
        }

        $sql .= " ORDER BY date_taken DESC";

        // Execute the query
        $result = mysqli_query($connect, $sql);

        // Check if any photos were found
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
            echo "<div class='no-photos'>No photos found matching your criteria.</div>";
        }

        // Close the database connection
        mysqli_close($connect);
    }
    ?>
</div>

</body>
</html>
