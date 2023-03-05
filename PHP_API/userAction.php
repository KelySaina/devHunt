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
        $sql = $conn->query("select PostLog.title, PostLog.DatePost, PostLog.Tags from PostLog join Notifs on PostLog.Matricule = Notifs.Matricule where Notifs.Matricule = '$mat' and Notifs.read_flag = 'n'");
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
        $m = $_POST['m'];
        $sql = $conn->query("SELECT PostLog.idpost, UserLog.matricule,UserLog.nom,UserLog.prenom,UserLog.classe, PostLog.content, PostLog.title, PostLog.tags, PostLog.datepost, PostLog.likes, PostLog.dislikes FROM PostLog join UserLog on PostLog.Matricule=UserLog.matricule where PostLog.matricule = '$m' order by PostLog.datepost desc");

        if ($sql->num_rows > 0) {
            $result['status'] = 'success';
            while ($row = $sql->fetch_assoc()) {
                array_push($result,$row);
            }
        }else{
            $result['status'] = 'error';
        }
    }
    if($action == 'getComs'){
        $iP = $_POST['idP'];
        $sql = $conn->query("select Comments.content, datecom from Comments join PostLog on PostLog.idPost = Comments.idPost where Comments.idPost = '$iP'");

        if ($sql->num_rows > 0) {
            $result['status'] = 'success';
            while ($row = $sql->fetch_assoc()) {
                array_push($result,$row);
            }
        }else{
            $result['status'] = 'error';
        }
    }

    if($action == 'like'){
        $idP = $_POST['idP'];
        $sql = $conn->query("update PostLog set Likes = Likes + 1 where idPost = '$idP'");
        if($sql){
            $result['status'] = 'success';
            $sql2 = $conn->query("select Likes from PostLog where idPost = '$idP'");
            if($sql2->num_rows>0){
                $row = $sql2->fetch_assoc();
                $result['like'] = $row['Likes'] ;
            }
            else{
                $result['like'] = 0;
            }
        }
        else{
            $result['status'] = 'error';
        }
    }

    if($action == 'dislike'){
        $idP = $_POST['idP'];
        $sql = $conn->query("update PostLog set Dislikes = Dislikes + 1 where idPost = '$idP'");
        if($sql){
            $result['status'] = 'success';
            $sql2 = $conn->query("select Dislikes from PostLog where idPost = '$idP'");
            if($sql2->num_rows>0){
                $row = $sql2->fetch_assoc();
                $result['dislike'] = $row['Dislikes'] ;
            }
            else{
                $result['dislike'] = 0;
            }
        }
        else{
            $result['status'] = 'error';
        }
    }

    if($action == 'postCom'){
        $idCom = rand(0, 100000);
        $idP = $_POST['idP'];
        $content = $_POST['content'];
        $matricule = $_POST['matricule'];
        $date = date('Y-m-d H:i:s');
        $sql = $conn->query("insert into Comments values ('$idCom','$idP','$matricule','$content','$date')");
        if($sql){
            $result['status'] = 'succes';
        }
        else{
            $result['status'] = 'error';
        }
    }


    $conn->close();
    echo json_encode($result);
?>