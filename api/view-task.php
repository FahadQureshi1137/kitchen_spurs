<?php require("../required/config.php") ?>

<?php
$read_user = "SELECT t.*,u.`username` FROM `task` AS t LEFT JOIN `users` AS u ON t.`assignUser` = u.`id`";
$result = $mysqli->query($read_user);

$response = array();

if (isset($_POST)) {
    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Append each row to the response array
                $response[] = $row;
            }
            // Encode the response array to JSON format
            $json_response = json_encode($response);
            // Send the JSON response
            header('Content-Type: application/json');
            echo $json_response;
        } else {
            // No rows found
            echo json_encode(array("message" => "No records found."));
        }
    } else {
        // Error in query execution
        echo json_encode(array("message" => "Query execution failed: " . $mysqli->error));
    }
}
?>