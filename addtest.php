<?php
    //Decode json
    $_POST = json_decode(file_get_contents("php://input"),true);

    if(isset($_POST['title']) && isset($_POST['questions']))
    {
        //Connect to database
        require 'database.php';

        //Add test
        $result = $mysqli_conection->query("INSERT INTO tests (`name`) VALUES (\"" . $_POST['title'] . "\")");
        $testid = mysqli_insert_id($mysqli_conection);

       foreach ($_POST['questions'] as $question) {
           //Add question
            $result = $mysqli_conection->query("INSERT INTO questions (`testid`,`question`,`quote`) VALUES (" . $testid . ",\"". $question["question"] . "\",\"" . $question["quote"] . "\")");
            $questionid = mysqli_insert_id($mysqli_conection);

            foreach ($question["answers"] as $answer)
            {
                //Add answer
                $result = $mysqli_conection->query("INSERT INTO answers (`questionid`,`answer`,`correct`) VALUES (" . $questionid . ",\"". $answer["answer"] . "\"," . $answer["correct"] . ")");
            }
        }

        $mysqli_conection -> close();
    }
    else
        echo "No post data.";
?>