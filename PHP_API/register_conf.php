<?php
// Define the database connection parameters
$servername = "localhost";
$username = "thyler";
$password = "k";
$dbname = "KS";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve the idreq from the request
$idreq = $_POST["idreq"];

// Sanitize the input data to prevent SQL injection attacks
$idreq = mysqli_real_escape_string($conn, $idreq);

// Retrieve the content of the request from the requests table
$sql = "SELECT content FROM Requests WHERE idreq='$idreq' AND read='n'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Request found, retrieve the content and insert into the user table
  $row = $result->fetch_assoc();
  $content = $row["content"];
  $data = explode(",", $content);
  
  $matricule = $data[1];
  $nom = $data[2];
  $prenom = $data[3];
  $classe = $data[4];
  $hash = $data[5];

  $sql = "INSERT INTO UserLog (matricule, nom, prenom, classe, password) VALUES ('$matricule', '$nom', '$prenom', '$classe', '$hash')";
  if ($conn->query($sql) === TRUE) {
    // Insert successful, update the read flag in the requests table
    $sql = "UPDATE requests SET read='y' WHERE idreq='$idreq'";
    if ($conn->query($sql) === TRUE) {
      // Update successful, insert the matricule into the notifs table with idpost 'Reg' + matricule
      $idpost = 'Reg' . $matricule;
      $sql = "INSERT INTO Notifs (IdPost, Matricule,Content) VALUES ('$idpost', '$matricule','Registration complete!')";
      if ($conn->query($sql) === TRUE) {
        // Insert successful, send a success response
        $response = array(
          "status" => "success",
          "message" => "Registration successful!"
        );
        echo json_encode($response);
      } else {
        // Insert failed, send an error response
        $response = array(
          "status" => "error",
          "message" => "Insert failed: " . $conn->error
        );
        echo json_encode($response);
      }
    } else {
      // Update failed, send an error response
      $response = array(
        "status" => "error",
        "message" => "Update failed: " . $conn->error
      );
      echo json_encode($response);
    }
  } else {
    // Insert failed, send an error response
    $response = array(
      "status" => "error",
      "message" => "Insert failed: " . $conn->error
    );
    echo json_encode($response);
  }
} else {
  // Request not found, send an error response
  $response = array(
    "status" => "error",
    "message" => "Request not found or already processed!"
  );
  echo json_encode($response);
}

// Close the database connection
$conn->close();
?>
