<?php require("../required/config.php") ?>

<?php

if (isset($_POST['submitEditTask'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $dueDate = $_POST['dueDate'];
    $status = $_POST['status'];
    $assignedUser = $_POST['assignedUser'];

    if (!empty($title) && !empty($description) && !empty($dueDate) && !empty($status) && !empty($assignedUser)) {
        $sql = "UPDATE `task` SET `title` = '$title', `description` = '$description', `dueDate` = '$dueDate', `status` = '$status' , `assignUser` = '$assignedUser' WHERE `id` = '$id'";
        $mysqli_query = $mysqli->query($sql);
        if ($mysqli_query) {
            // Fetch the updated task
            $read_task = "SELECT t.*, u.`username` FROM `task` AS t LEFT JOIN `users` AS u ON t.`assignUser` = u.`id` WHERE t.`id` = '$id'";
            $result_task = $mysqli->query($read_task);

            if ($result_task && $result_task->num_rows > 0) {
                $row = $result_task->fetch_assoc();
                // Encode the fetched task into JSON format
                $json_response = json_encode($row);
                // Send the JSON response
                header('Content-Type: application/json');
                echo $json_response;
            } else {
                // Task not found
                echo json_encode(array("message" => "Task not found."));
            }
        } else {
            // Error in query execution
            echo json_encode(array("message" => "Error updating task: " . $mysqli->error));
        }
    } else {
        // Validation error
        echo json_encode(array("message" => "Validation error: Some fields are empty."));
    }
} else {
    // Invalid request
    echo json_encode(array("message" => "Invalid request."));
}
