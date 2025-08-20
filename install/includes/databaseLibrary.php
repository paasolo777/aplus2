<?php

class Database
{

    function create_tables($data)
    {
        $servername = $data['hostname'];
        $username = $data['username'];
        $password = $data['password'];
        $database = $data['database'];
        $conn = new mysqli($servername, $username, $password);
        if ($conn->connect_error) {
            return false;
        }
        $sql = "SHOW DATABASES LIKE '$database'";
        $result = $conn->query($sql);
        if (!$result->num_rows > 0) {
            $conn->close();
            return false;
        }
        $conn->close();
        $mysqli = new mysqli($servername, $username, $password, $database);
        if ($mysqli->connect_error) {
            return false;
        } else {
            $query = file_get_contents('assets/quiz.php');
            if ($query === false) {
                $mysqli->close();
                return false;
            }
            if ($mysqli->multi_query($query)) {
                $mysqli->close();
                return true;
            }
        }
        $mysqli->close();
        return false;
    }
}
