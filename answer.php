<?php
require_once("class.quiz.php");
$quiz = new quiz();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quiz : <?= $quiz->prettyName($_SESSION['quiz']) ?></title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <div class='wrapper'>
        <h1><?= $quiz->prettyName($_SESSION['quiz']) ?></h1>
        <hr>
        <?= $quiz->checkAnswer($_GET['a']); ?>
    </div>
</body>
</html>