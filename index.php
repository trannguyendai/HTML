<?php
// index.php
session_start();
session_destroy();

require_once("class.quiz.php");
$quiz = new quiz();


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quiz</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>

    <div class="wrapper">
        <h1>Chọn bộ đề thi để bắt đầu</h1>
        <hr>
        <?= $quiz->showQuizes(); ?>

    </div>

</body>
</html>