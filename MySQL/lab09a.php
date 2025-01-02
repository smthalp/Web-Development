<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab09a</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #eee6e6;
            margin: 0;
            padding: 0;
            color: #7a4a53;
        }

        header {
            background-color: #bea4a5;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #bea4a5;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .success-message, .error-message {
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .success-message {
            background-color: #e3b8bd;
            border: 1px solid #d1abad;
        }

        .error-message {
			background-color: #e3b8bd;
            border: 1px solid #d1abad;
            color: #721c24;
        }

        p {
            font-size: 16px;
        }
    </style>
</head>
<body>

<header>
    <h1>Data Insertion</h1>
</header>

<div class="container">
    <?php
    $host = "localhost";
    $database = "slopapa";
    $user = "slopapa";
    $password = "WM150BLD";

    // Establish connection
    $connect = mysqli_connect($host, $user, $password, $database) or die(mysqli_error($connect));

    // Checking if the table already exists
    $table = 'Photos';
    $exists = false;

    $show = "SHOW TABLES";
    $result = mysqli_query($connect, $show);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $currTable = $row["Tables_in_$database"];
            if ($table == $currTable) {
                $exists = true;
            }
        }
    }

    // If the table doesn't exist, create it and insert records
    if (!$exists) {
        $newTableSQL = "
            CREATE TABLE Photos (
                picture_number INT PRIMARY KEY,
                subject VARCHAR(255),
                location VARCHAR(255),
                date_taken DATE,
                picture_url VARCHAR(255)
            );
        ";
        
        $create = mysqli_query($connect, $newTableSQL);

        // Insert records into Photos table
        $sql = "INSERT INTO Photos (picture_number, subject, location, date_taken, picture_url) 
                VALUES ('1','Pug', 'Ontario', '2020-12-03', 'pics/Pug.jpg');";
        $sql .= "INSERT INTO Photos (picture_number, subject, location, date_taken, picture_url) 
                  VALUES ('2','Poodle', 'Quebec', '2023-10-30', 'pics/Poodle.jpg');";
        $sql .= "INSERT INTO Photos (picture_number, subject, location, date_taken, picture_url) 
                  VALUES ('3','Pomeranian', 'Ontario', '2019-10-29', 'pics/Pomeranian.jpg');";
        $sql .= "INSERT INTO Photos (picture_number, subject, location, date_taken, picture_url) 
                  VALUES ('4','Golden-Retriever', 'Alberta', '2016-04-30', 'pics/Golden-Retriever.jpg');";
        $sql .= "INSERT INTO Photos (picture_number, subject, location, date_taken, picture_url) 
                  VALUES ('5','German-Shepherd', 'Yukon', '2020-05-06', 'pics/German-Shepherd.jpg');";
        $sql .= "INSERT INTO Photos (picture_number, subject, location, date_taken, picture_url) 
                  VALUES ('6','Chow-Chow', 'Nunavut', '2014-02-16', 'pics/Chow-Chow.jpg');";
        $sql .= "INSERT INTO Photos (picture_number, subject, location, date_taken, picture_url) 
                  VALUES ('7','Bulldog', 'Quebec', '2024-07-07', 'pics/Bulldog.jpg');";
        $sql .= "INSERT INTO Photos (picture_number, subject, location, date_taken, picture_url) 
                  VALUES ('8','Boston-Terrier', 'Ontario', '2015-08-25', 'pics/Boston-Terrier.jpg');";
        $sql .= "INSERT INTO Photos (picture_number, subject, location, date_taken, picture_url) 
                  VALUES ('9','Border-Collie', 'British-Columbia', '2017-01-17', 'pics/Border-Collie.jpg');";
        $sql .= "INSERT INTO Photos (picture_number, subject, location, date_taken, picture_url) 
                  VALUES ('10','Rottweiler', 'Alberta', '2020-10-29', 'pics/Rottweiler.jpg');";

        // Execute the SQL queries
        if (mysqli_multi_query($connect, $sql)) {
            echo "<div class='success-message'>Multiple records added successfully.</div>";
        } else {
            echo "<div class='error-message'>Error: " . $sql . "<br>" . mysqli_error($connect) . "</div>";
        }
    } else {
        echo "<div class='success-message'>Data has been inserted.</div>";
    }

    mysqli_close($connect);
    ?>
</div>

</body>
</html>
