<?php
require_once("class.quiz.php");
$quiz = new quiz();

if (!isset($_GET['quiz']) && !empty($_GET['quiz'])) {
    header("Location:index.php");
}

if (!isset($_SESSION['round'])) {
    $_SESSION['round'] = 1;
}

if (!isset($_SESSION['quiz'])) {
    $_SESSION['quiz'] = $_GET['quiz'];
}

if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}

/*echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";
	$quiz = parse_ini_file("./quizes/" . $_SESSION['quiz'], true);
	echo "<pre>";
	print_r($quiz);
	echo "</pre>";*/

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quiz : <?php echo $quiz->prettyName($_GET['quiz']) ?></title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <a href='index.php' style='text-align:rightr'><br>Quay lại trang chủ</a>
    <div class='wrapper'>
        <h1><?= $quiz->prettyName($_GET['quiz']) ?></h1>
        <hr>
        <?= $quiz->showQuestion(); ?>
        <hr style='clear:both;'>
        <br>
    </div>

</body>
</html>