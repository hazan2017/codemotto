<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "forumdb";

    //create database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $topic_id = $_POST["topic_id"];

    $sql = "";

    if ($topic_id == 0) {
        $sql = "SELECT * FROM discussion ORDER BY time_added DESC LIMIT 8;";
    }
    else {
        $sql = "SELECT * FROM discussion WHERE topic_id = ".$topic_id.";";
    }

    $result = $conn->query($sql);

    $counter = 0;
    $data = "[";
    
    if ($result->num_rows > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            if ($counter > 0) {
                $data .= ', ';
            }
            $data .= '{"topicId": "' . $row["topic_id"] . '", ';
            $data .= '"discussionId": "' . $row["discussion_id"] . '", ';
            $data .= '"discussion": "' . $row["discussion"] . '", ';
//            $data .= '"explaination": "' . $row["explanation"] . '", ';
//            $data .= '"code": "' . $row["actual_code"] . '", ';
            $data .= '"addedBy": "' . $row["added_by"] . '", ';
            $data .= '"timeAdded": "' . $row["time_added"] . '", ';
            $data .= '"viewsCounter": "' . $row["views_counter"] . '", ';
            $data .= '"answersCounter": "' . $row["answers_counter"] . '"}';
            $counter++;
        }
    }

    $data .= "]";

    echo ($data);

?>