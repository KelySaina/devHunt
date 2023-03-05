<?php

// Initialize database connection
$servername = "localhost";
$username = "thyler";
$password = "k";
$dbname = "KS";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from POST request
$data = json_decode(file_get_contents('php://input'), true);
$idPost = rand(0, 100000);
$matricule = $_POST['matricule'];
$title = $_POST['title'];
$content = $_POST['content'];
$date = date('Y-m-d H:i:s');
$tags = $_POST['tags'];
$code = $_POST['code'];


// Prepare and execute SQL query to insert blog post
$stmt = $conn->prepare("INSERT INTO PostLog (idPost, matricule, title, content,code, datePost, tags) VALUES (?, ?, ?, ?, ?, ?,?)");
$stmt->bind_param("sssssss", $idPost, $matricule, $title, $content,$code, $date, $tags);
$stmt->execute();

// Check if the SQL statement has been executed successfully
if ($stmt->affected_rows > 0) {
    // Close database connection
    $conn->close();
    
    // Send response to Axios
    $response = array('status' => 'success', 'message' => 'The SQL statement has been executed successfully');
    echo json_encode($response);
} else {
    // Close database connection
    $conn->close();
    
    // Send response to Axios
    $response = array('status' => 'error', 'message' => 'The SQL statement failed to execute');
    echo json_encode($response);
}
?>

