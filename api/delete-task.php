<?php require("../required/config.php") ?>

<?php
if (isset($_POST['deleteTask'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM `task` WHERE `id` = '$id'";
    $mysqli_query = $mysqli->query($sql);

    if ($mysqli_query) {
        // Fetch the deleted task before deletion
        $read_deleted_task = "SELECT * FROM `task` WHERE `id` = '$id'";
        $result_deleted_task = $mysqli->query($read_deleted_task);

        if ($result_deleted_task && $result_deleted_task->num_rows > 0) {
            $deleted_row = $result_deleted_task->fetch_assoc();
            // Encode the fetched task into JSON format
            $json_response = json_encode($deleted_row);
            // Send the JSON response
            header('Content-Type: application/json');
            echo $json_response;
        } else {
            // Task not found (either already deleted or doesn't exist)
            echo json_encode(array("message" => "Task not found."));
        }
    } else {
        // Error in query execution
        echo json_encode(array("message" => "Error deleting task: " . $mysqli->error));
    }
} else {
    // Invalid request
    echo json_encode(array("message" => "Invalid request."));
}

?>