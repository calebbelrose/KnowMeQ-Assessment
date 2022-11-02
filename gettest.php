<?php
    if(isset($_GET['id']))
    {
        //Connect to database
        require 'database.php';
        $result = $mysqli_conection->query("SELECT t.name, q.question, q.quote, a.answer, a.correct FROM questions q JOIN answers a ON a.questionid = q.id JOIN tests t on q.testid = t.id WHERE q.testid = " . $_GET['id'] . " ORDER BY q.id");

        $returnData = array();

        //Get test questions and answers
        $result = $mysqli_conection->query("SELECT t.name, q.question, q.quote, a.answer, a.correct FROM questions q JOIN answers a ON a.questionid = q.id JOIN tests t on q.testid = t.id WHERE q.testid = " . $_GET['id'] . " ORDER BY q.id");
        
        if($row = $result->fetch_assoc())
        {
            $temp = array(
            "name" => $row["name"],
            "question" => $row["question"],
            "quote" => $row["quote"],
            "answers" => array(array($row["answer"], $row["correct"])));

            //Bind questions and answers to return array
            while ($row = $result->fetch_assoc())
            {
                if($row["question"] == $temp["question"])
                {
                    array_push($temp["answers"], array($row["answer"], $row["correct"]));
                }
                else
                {
                    $returnData[] = $temp;
                    $temp = array(
                    "name" => $row["name"],
                    "question" => $row["question"],
                    "quote" => $row["quote"],
                    "answers" => array(array($row["answer"], $row["correct"])));
                }
            }

            $returnData[] = $temp;
        }

        $result -> free_result();
        $mysqli_conection -> close();
            
        //Encode to JSON
        echo json_encode($returnData);
    }
?>