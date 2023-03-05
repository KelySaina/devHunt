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

    // Retrieve the registration data from the request
    $matricule = $_POST["matricule"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $classe = $_POST["classe"];
    $password = $_POST["password"];
    $type = $_POST['type'];

    // Sanitize the input data to prevent SQL injection attacks
    $matricule = mysqli_real_escape_string($conn, $matricule);
    $nom = mysqli_real_escape_string($conn, $nom);
    $prenom = mysqli_real_escape_string($conn, $prenom);
    $classe = mysqli_real_escape_string($conn, $classe);
    $password = mysqli_real_escape_string($conn, $password);

    // Hash the password using the bcrypt algorithm
    //$hash = password_hash($password, PASSWORD_BCRYPT);

    // Generate a random IdReq number between 0 and 10000000
    $idreq = rand(0, 10000000);

    // Build a comma-separated string of the registration data
    $content = "$nom,$prenom,$classe,$hash";

    // Insert the registration data into the requests table
    //$sql = "INSERT INTO Requests (idreq, matricule, content,req_type) VALUES ('$idreq', '$matricule','$content',$type)";
    $sql = "INSERT INTO UserLog (matricule, nom, prenom, classe, password) VALUES ('$matricule', '$nom', '$prenom', '$classe', '$password')";

    if ($conn->query($sql) === TRUE) {
    // Registration successful, send a success response
    $response = array(
        "status" => "success",
        "message" => "Registration Complete!"
    );
    echo json_encode($response);
    } else {
    // Registration failed, send an error response
    $response = array(
        "status" => "error",
        "message" => "Registration failed: " . $conn->error
    );
    echo json_encode($response);
    }

    // Close the database connection
    $conn->close();
?>
