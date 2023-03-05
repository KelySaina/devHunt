<?php
    header ("Access-Control-Allow-Origin:*");
            
    $conn = new mysqli("localhost", "thyler", "k", "KS");
    if($conn->connect_error){
        die("Connection Failed!".$conn->connect_error);
    }

    $result = array('error'=>false);

    $action = '';

    if(isset($_GET['action'])){
        $action = htmlspecialchars($_GET['action']);
    }

    if($action == "getInfo"){
        $mat = $_POST['ml'];
        $sql = $conn->query("select matricule, nom, prenom, classe,skills,interests,IsMentor from UserLog where matricule = '$mat'");
        if($sql->num_rows>0){
            $result['status'] = 'success';
            while($row = $sql->fetch_assoc()){
                array_push($result,$row);
            }
        }
        else{
            $result['status'] = 'error';
        }
    }

    if($action == 'getNotifs'){
        $mat = $_POST['ml'];
        $sql = "select PostLog.title, PostLog.Date, PostLog.Tags from PostLog join Notifs on PostLog.Matricule = Notifs.Matricule where Notifs.Matricule = '$mat' and Notifs.read_flag = 'n'";
        if($sql->num_rows>0){
            $result['status'] = 'success';
            while($row = $sql->fetch_assoc()){
                array_push($result, $row);
            }
        }
        else{
            $result['status'] = 'error';
        }
    }

    if($action == 'getPosts'){
        $sql = "SELECT idpost, matricule, content, title, tags, datepost, likes, dislikes FROM PostLog where matricule = '$m";
        $result = $conn->query($sql);

        // Convert the result to an array
        $posts = array();
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        }

        // Return the posts as a JSON response
        header('Content-Type: application/json');
        echo json_encode($posts);

        // Close the database connection
        $conn->close();
    }


    $conn->close();
    echo json_encode($result);
?>