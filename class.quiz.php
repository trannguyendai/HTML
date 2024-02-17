<?php

session_start();

class Quiz {

    public function showQuizes() {
        $output = "";
        $foundQuizes = scandir("./quizes/");

        foreach ($foundQuizes as $file) {
            if ($file == "." || $file == "..") {
                continue;
            }

            $output .= "<a href='start.php?quiz=$file' class='quiz'>" . $this->prettyName($file) . "</a>";
        }

        return $output;
    }

    public function prettyName($name) {
        $niceName = str_replace("_", " ", $name);
        $niceName = str_replace(".ini", "", $niceName);
        return $niceName;
    }

    public function showQuestion() {
        $output = "";
        $quiz = parse_ini_file("./quizes/" . $_SESSION['quiz'], true);

        if (mb_stripos($_SESSION['quiz'], 'ôn tập') !== false) {
            $randomQuestionIndex = mt_rand(1, count($quiz));
            $randomQuestionKey = "QUESTION-" . $randomQuestionIndex;
            $_SESSION['round'] = $randomQuestionIndex;
            $question = $quiz[$randomQuestionKey]["question"];
        } else {
            $question = $quiz["QUESTION-" . $_SESSION['round']]["question"];
        }

        $output .= "<div class='question'>$question (" . $_SESSION['round'] . "/" . count($quiz) . ")</div>";

        for ($i = 1; $i <= 5; $i++) {
            $answerKey = "answer" . $i;

            if (isset($quiz["QUESTION-" . $_SESSION['round']][$answerKey]) && $quiz["QUESTION-" . $_SESSION['round']][$answerKey] != "") {
                $output .= "<a href='answer.php?a=$i' class='answer'>($i): " . $quiz["QUESTION-" . $_SESSION['round']][$answerKey] . "</a>";
            }
        }

        return $output;
    }

    public function checkAnswer($index) {
        $quiz = parse_ini_file("./quizes/" . $_SESSION['quiz'], true);

        if ($quiz["QUESTION-" . $_SESSION['round']]["correctAnswer"] == $index) {
            $_SESSION['score']++;
            $output = "<h3>Chính xác!!!</h3>";
            $output .= $this->displayAnswer($quiz, $_SESSION['round']);
        } else {
            $output = "<h2>Sai rồi...</h2>";
            $output .= "<br>Đáp án đúng là: " . $quiz["QUESTION-" . $_SESSION['round']]["correctAnswer"];
            $output .= $this->displayAnswer($quiz, $_SESSION['round']);
        }

        if (mb_stripos($_SESSION['quiz'], 'ôn tập') !== false) {
            $numOfQuestions = 99999;
        } else {
            $numOfQuestions = count($quiz);
        }

        $_SESSION['round']++;

        if ($_SESSION['round'] <= $numOfQuestions) {
            $output .= "<br><a href='start.php?quiz=" . $_SESSION['quiz'] . "'>Câu hỏi tiếp theo</a>";
        } else {
            $output .= "<br><span class='result'>Score: " . $_SESSION['score'] . " / " . count($quiz) . "</span><br>";
            $output .= "<a href='index.php'>Quay lại</a>";
        }

        return $output;
    }

    private function displayAnswer($quiz, $round) {
        $output = "";

        $output .= "<br><br>Câu hỏi: " . $quiz["QUESTION-" . $round]["question"];

        for ($i = 1; $i <= 6; $i++) {
            $answerKey = "answer" . $i;

            if (isset($quiz["QUESTION-" . $round][$answerKey]) && $quiz["QUESTION-" . $round][$answerKey] != "") {
                $output .= "<p href='#' class='";

                if ($i == $quiz["QUESTION-" . $round]["correctAnswer"]) {
                    $output .= "correct-answer";
                }

                $output .= "'>($i) " . $quiz["QUESTION-" . $round][$answerKey] . "</p>";
            }
        }

        return $output;
    }
}

?>