<?php require("../required/config.php") ?>

<?php
if (isset($_POST["username"], $_POST["email"], $_POST["password"])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($email) && !empty($password)) {
        $sql = "INSERT INTO `users` (`username`, `email`, `password`) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $username, $email, $password);
            $stmt->execute();
            $stmt->close();

            // Fetch the newly inserted user
            $new_user_id = $mysqli->insert_id;
            $read_user = "SELECT * FROM `users` WHERE `id` = '$new_user_id'";
            $result_user = $mysqli->query($read_user);

            if ($result_user && $result_user->num_rows > 0) {
                $row = $result_user->fetch_assoc();
                // Encode the fetched user into JSON format
                $json_response = json_encode($row);
                // Send the JSON response
                header('Content-Type: application/json');
                echo $json_response;
            } else {
                // User not found
                echo json_encode(array("message" => "User not found."));
            }
        } else {
            // Error in prepared statement
            echo json_encode(array("message" => "Error in prepared statement: " . $mysqli->error));
        }
    } else {
        // All fields are required
        echo json_encode(array("message" => "All fields are required."));
    }
} else {
    // Invalid request
    echo json_encode(array("message" => "Invalid request."));
}

?>
