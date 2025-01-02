<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 8 PHP</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
			text-align:center;
			justify-content: center;
			display: flex;
			align-items:center;
			flex-direction: column; 
        }

		h1 {
			margin-left:10px;
		}
        .background {
            display: flex;
            justify-content: center;
            align-items: center;
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 60vh;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            transition: background-image 0.5s ease-in-out;
        }

        .greeting {
            font-size: 3rem;
            text-align: center;
            padding: 20px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }
		
		.title {
			font-size: 3.5rem;
			text-align:center;
		}
		table {
            border-collapse: collapse;
            margin-top: 20px auto;
        }
        td {
            border: 2px solid #000;
            padding: 10px;
            text-align: center;
            background-color: #f0f0f0;
        }
        form {
            margin-bottom: 20px;
        }
		
		.image-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin: 20px 0;
        }

        .image-grid img {
            width: 150px;
            height: auto;
            cursor: pointer;
            border: 2px solid transparent;
            transition: transform 0.3s ease, border 0.3s ease;
        }

        .image-grid img:hover {
            transform: scale(1.1);
            border: 2px solid orange;
        }

        .corner {
            position: fixed;
            top: 10px;
            right: 10px;
            opacity: 0.7;
            max-width: 150px;
            max-height: 150px;
            z-index: 1000;
        }

        .current-image {
            text-align: center;
            font-size: 1.5rem;
            margin-top: 20px;
            color: #333;
        }
    </style>
</head>
<body>
	<h1 class="title"> Lab 8 </h1>
	<h1> Greeting </h1>
    <?php
        $hour = date('G');
        $background = '';
        $greeting = '';

        switch (true) {
            case ($hour >= 5 && $hour < 12):
                $background = 'morning.jpg';
                $greeting = 'Good Morning';
                break;
            case ($hour >= 12 && $hour < 17):
                $background = 'afternoon.jpg';
                $greeting = 'Good Afternoon';
                break;
            case ($hour >= 17 && $hour < 20):
                $background = 'evening.jpg';
                $greeting = 'Good Evening';
                break;
            default:
                $background = 'night.jpg';
                $greeting = 'Good Night';
        }
    ?>
    <div class="background" style="background-image: url('<?php echo $background; ?>');">
        <div class="greeting"><?php echo $greeting; ?></div>
    </div>
	
	<h1> Multiplication Table </h1>
    <form method="POST">
	<input type="hidden" name="type" value="table">
        <label for="numA">Enter Rows (3-12): </label>
        <input type="number" id="numA" name="numA" required>
        <label for="numB">Enter Columns (3-12): </label>
        <input type="number" id="numB" name="numB" required>
        <button type="submit">Go</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type']) && $_POST['type'] == 'table') {
        $a = (int)$_POST['numA'];
        $b = (int)$_POST['numB'];

        if ($a >= 3 && $a <= 12 && $b >= 3 && $b <= 12) {
            echo '<table>';
            for ($i = 1; $i <= $a; $i++) {
                echo '<tr>';
                for ($j = 1; $j <= $b; $j++) {
                    echo '<td>' . ($i * $j) . '</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p style="color: red;">Please enter integers between 3 and 12</p>';
        }
    }
    ?>


	<h1>Favourite Image</h1>
	<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['chosenImage']) && isset($_POST['type']) && $_POST['type'] == 'picture') {
        $chosenImage = $_POST['chosenImage'];
        setcookie('favoriteImage', $chosenImage, time() + 86400);
		header('Location: ' . $_SERVER['PHP_SELF']);
		exit;
    }

    $favoriteImage = isset($_COOKIE['favoriteImage']) ? $_COOKIE['favoriteImage'] : null;
    ?>
	
    <?php if ($favoriteImage): ?>
        <img src="<?= $favoriteImage ?>" alt="Favorite Image" class="corner">
		<div>Image has been set.</div>
        <div class="current-image">Current image: <?= basename($favoriteImage) ?></div>
	<?php else: ?>
		<div>Select your favourite image.</div>
    <?php endif; ?>
	<form method="POST">
		<input type="hidden" name="type" value="picture">
        <div class="image-grid">
            <?php
            $images = [
                'turkey.gif',
                'barrow.gif',
                'leaf.gif',
                'wreath.gif',
                'cornucopia.gif'
            ];

            foreach ($images as $image) {
                echo "
                <label>
                    <input type='radio' name='chosenImage' value='$image' required>
                    <img src='$image' alt='$image'>
                </label>";
            }
            ?>
        </div>
        <button type="submit" style="padding: 10px 20px; font-size: 1rem; cursor: pointer;">Set Favorite Image</button>
    </form>
</body>
</html>