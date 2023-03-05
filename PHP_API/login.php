<?php

    // Retrieve the Matricule and password from the request and sanitize them
    $matricule = filter_input(INPUT_POST, 'matricule', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Validate the Matricule and password
    if (!$matricule || !$password) {
        $response = array('status' => 'error', 'message' => 'Invalid input');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    

    // Connect to the database using mysqli object-oriented interface
    $host = "localhost";
    $user = "thyler";
    $password = "k";
    $database = "KS";
    $conn = new mysqli($host, $user, $password, $database);

    // Check for errors
    if ($conn->connect_error) {
        $response = array('status' => 'error', 'message' => 'Failed to connect to MySQL: ' . $conn->connect_error);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    // Query the database for the user using prepared statements
    $stmt = $conn->prepare("SELECT * FROM UserLog WHERE Matricule=? AND password=?");
    $stmt->bind_param('ss', $matricule, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows == 1) {
        // User exists, return success
        $response = array('status' => 'success');
        session_start();
        $_SESSION['log'] = true;
        $_SESSION['matricule'] = $matricule;
    } else {
        // User does not exist, return error
        $response = array('status' => 'error', 'message' => 'Invalid Matricule or password');
    }

    // Close the database connection and return the response as JSON
    $stmt->close();
    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($response);
?>
