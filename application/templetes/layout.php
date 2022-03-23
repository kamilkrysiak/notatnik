<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style.css">
    <title>I'm learning</title>
</head>
<body>
    <header>
        <nav>
            <ul class="menu">
                <li>
                    <a href="/">Strona Główna</a>
                </li>
                <li>
                    <a href="/?action=create">Nowa Notatka</a>
                </li>
            </ul>
        </nav>
</header>

<main>
<?php require_once("templetes/pages/$page.php"); ?>
</main>

<footer>
    <p>notatnik w php</p>
</footer>
</body>
</html>