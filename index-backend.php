<?php require("./required/config.php") ?>
<?php


if (!isset($_SESSION['LoggedIn'])) {
    header("Location:login.php");
    exit();
}

// CREATE TASK [INSERT]
if (isset($_POST["createTask"])) {
    $title = ($_POST['title']);
    $description = ($_POST['description']);
    $dueDate = ($_POST['dueDate']);
    $status = ($_POST['status']);
    $assignedUser = ($_POST['assignedUser']);
    if (!empty($title) && !empty($description) && !empty($dueDate) && !empty($status) && !empty($assignedUser)) {
        $sql = "INSERT INTO `task`(`title`,`description`,`dueDate`,`status`,`assignUser`) VALUE ('$title','$description','$dueDate','$status','$assignedUser')";
        $run = $mysqli->query($sql);
        unset($_POST);
        header('location:index.php');
    }
}
// CREATE TASK [INSERT]
// UPDATE TASK [UPDATE]
if (isset($_POST['submitEditTask'])) {
    $id = $_POST['id'];
    $title = ($_POST['title']);
    $description = ($_POST['description']);
    $dueDate = ($_POST['dueDate']);
    $status = ($_POST['status']);
    $assignedUser = ($_POST['assignedUser']);
    if (!empty($title) && !empty($description) && !empty($dueDate) && !empty($status) && !empty($assignedUser)) {
        $sql = "UPDATE `task` SET `title` = '$title',`description` = '$description', `dueDate` = '$dueDate',`status` = '$status' ,`assignUser` = '$assignedUser' WHERE `id` = '$id'";
        $mysqli_query = $mysqli->query($sql);
        if ($mysqli_query)
            unset($_POST);
    }
    header("location:index.php");
    exit();
}
// UPDATE TASK [UPDATE]
// DELETE_TASK [DELETE]
if (isset($_POST['deleteTask'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM `task` WHERE `id` = '$id'";
    $mysqli_query = $mysqli->query($sql);
    header("Location:index.php");
    exit();
};
// DELETE_TASK [DELETE]
?>