<?php
    session_start();
    if($_SESSION['log'] == true){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/profil.css">
    <title>KS | User Profile</title>
    <script src="./JS/axios.min.js"></script>
    <script src="./JS/vue.min.js"></script>
    <link rel="stylesheet" href="./CSS/post.css">
    <link rel="stylesheet" href="./codemirror/lib/codemirror.css">
	<script src="./codemirror/lib/codemirror.js"></script>
</head>
<body>
    <div id="userProfile">
        <div id="coteGauche">
            <div class="PDC">
                <p>{{fullname}}{{classe}}</p>
            </div>
            <div class="PDP">
                <p>{{mat}}</p>
            </div>
            <div id='aboutU'>
                <div class="aproposUser">
                    <p>{{mentor}}</p>
                    <p>{{skills}}{{interests}} </p>
                </div>
                <div class="settingProfil">
                    <button class="setting-btn" onclick=""><img src="./assets/settings.png" alt="" srcset=""></button>
                </div>
            </div>
            
            <div class="navigation">
                <a id="chat" href="./HTML/post.php"><button>Ask a question</button></a>
                <a id="chat" href="./CHAT/users.php"><button>Join chat</button></a>
                <button onclick="nf = true">Notifications</button>
                <a id="chat" href="./SIM/index.html"><button>Code Simulator</button></a>
            </div>
            <div id="afficherPost"v-for="post in posts">
                    <p>
                        <span>{{post.matricule}}</span> {{post.nom}} {{post.prenom}}<br>
                        {{post.title}}: {{post.content}}<br>
                        {{post.tags}}
                    </p>
                    <p><a href="" @click="likeP(post.idpost)">Like</a> ({{post.likes}})<br><a href=""@click="dislikeP(post.idpost)">Dislike</a>({{post.dislikes}})</p>

            </div>
        </div>  
        <div id="coteDroite">
            <div id="recherche">
                <form action="" method="POST">
                    <button name="lo" style=" width: 100%; height: 50px; border: none; background: #333;color: white;border-radius: 25px;">Log Out</button>
                </form>
                
                <?php
                    if(isset($_POST['lo'])){
                        session_destroy();
                        header('Location:http://localhost:1060');
                    }
                ?>
            </div>
            <div id="propMentor">
                <p>Mentor proposition</p>
                <div id="mentorDiv">
                    <div class="profilMentor">
        
                    </div>
                    <div class="aproposMentor">
                        <div class="nomMentor">Andrianina Manda Arolala</div>
                        <div class="FollowMentor"><button>Follow</button></div>
                    </div>
                </div>
                <div class="voisPlus">
                    <a href="#">Show more...</a>
                </div>
            </div>
            <div id="interestingThings">
                <p class="enteteIT">Interesting things</p>
                <div id="resumePost">
                    <p class="etiquette">Language C</p>
                    <p class="aproposEtiquete">High-level programming language</p>
                </div>
                <div class="voisPlus">
                    <a href="#">Show more...</a>
                </div>
            </div>
        </div>
    </div>
    <script>var m = "<?php echo $_SESSION['matricule']?>";</script>
    <script src="./JS/index.js"></script>
    <script>
		var myTextarea = document.getElementById("myTextarea");
        var myCodeMirror = CodeMirror.fromTextArea(myTextarea, {
        mode: "javascript",
        lineNumbers: true,
        theme: "default"
        });
        myCodeMirror.setSize(null, "198px");
	</script>
    <script src="./JS/post_q.js"></script>
    
</body>
<?php
    }
else{
    header('Location:http://localhost:1060/HTML/login.html');
}?>
</html>