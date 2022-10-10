<?php
    if(isset($_GET['id']))
    {
        //Connect to database
        require 'database.php';
        $returnData = array();

        //Get test questions and answers
        $result = $mysqli_conection->query("SELECT t.name AS name, q.question AS question, q.quote AS quote, q.answer0 AS answer0, q.answer1 AS answer1, q.answer2 AS answer2, q.answer3 AS answer3, q.correctindex AS correctindex FROM                tests t, questions q WHERE t.id = q.testid AND t.id = " . $_GET['id']);

        //Bind questions and answers to return array
        while ($row = $result->fetch_assoc())
        {
            $temp = array(
                "name" => $row["name"],
            "question" => $row["question"],
            "quote" => $row["quote"],
            "correctindex" => $row["correctindex"],
            "answers" => array($row["answer0"],$row["answer1"],$row["answer2"],$row["answer3"]));
            $returnData[] = $temp;
        }

        $result -> free_result();
        $mysqli_conection -> close();
            
        //Encode to JSON
        echo json_encode($returnData);
    }
?>