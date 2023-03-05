<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KS | Create post</title>
    <link rel="stylesheet" href="../CSS/post.css">
	<link rel="stylesheet" href="../codemirror/lib/codemirror.css">
	<script src="../codemirror/lib/codemirror.js"></script>
    
	<style>
	/* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.5);
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

	</style>
</head>
<body>
	<div id="modal" class="modal" style="display: block;">
		
			<div class="container" style="background: #ffff;" >
				<div class="modal-body" style="align-items: center;">
					<h3>Ask something </h3>
                    <div style="display: flex;justify-content: space-around; margin: 3px;">
                        <div style="width: 45%;">
                            <label id="la"  >Title <span id="ii">*</span></label><br>
                            <input type="text" name="Title"id="title" class="cat" required>
                        </div>
                        
                        <div style="width: 45%;">
                            <label id="la" >Tags <span id="ii">*</span></label><br>
                            <input type="text" name="cat" id="tags" class="cat" required>    
                        </div>
                        
                    </div>
                    
                    <div>
                        <label id="la">Post Description <span id="ii">*</span></label><br>
                        <textarea id = "content"style="width: 100%;height: 100px;resize: none;" required></textarea>
                    </div>
                    
                    
                    <textarea id="myTextarea" style="height: 199px;"></textarea>
                    
                    <a href="../index.php"><input type="button" id="close-modal" value="Cancel" class="post" style="background: #f00;color: #ffff; border: none;" ></a>
                    <input type="button" value="Post" class="post" onclick="post();" style="margin-right: 5%;background: #008000;color: #ffff;border: none;">
				</div>
				
			</div>
	</div>
    <script>var m = "<?php echo $_SESSION['matricule']?>";</script>
    <script src="../JS/post_q.js"></script>
    <script src="../JS/axios.min.js"></script>
	<script>
		var myTextarea = document.getElementById("myTextarea");
        var myCodeMirror = CodeMirror.fromTextArea(myTextarea, {
        mode: "javascript",
        lineNumbers: true,
        theme: "default"
        });
myCodeMirror.setSize(null, "198px");
	</script>
</body>
</html>
