<?php require("./required/config.php") ?>
<?php
if (!isset($_SESSION['LoggedIn'])) {
  header("Location:login.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <!-- Boxicons -->
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- My CSS -->
  <link rel="stylesheet" href="style.css" />
  <title>Kitchen Spurs</title>
</head>

<body>
  <!-- SIDEBAR -->
  <section id="sidebar">
    <a href="index.php" class="brand">
      <i class="bx bxs-smile"></i>
      <span class="text">Kitchen Spurs</span>
    </a>
    <ul class="side-menu top">
      <li>
        <a href="index.php">
          <i class="bx bxs-dashboard"></i>
          <span class="text">Task</span>
        </a>
      </li>
      <li>
        <a href="users.php">
          <i class="bx bxs-shopping-bag-alt"></i>
          <span class="text">Users</span>
        </a>
      </li>
    </ul>
    <ul class="side-menu">
      <?php if (isset($_SESSION['LoggedIn'])) { ?>
        <li>
          <a href="logout.php">
            <i class="bx bxs-log-out-circle"></i>
            <span class="text">Logout</span></a>
        </li>
      <?php } ?>
    </ul>
  </section>
  <!-- SIDEBAR -->
  <!-- CONTENT -->
  <section id="content">
    <!-- NAVBAR -->
    <nav class=" d-flex justify-content-between">
      <div class="d-flex">
        <i class="bx bx-menu my-auto"></i>
        <a href="#" class="nav-link">Categories</a>
      </div>
      <div class="">
        <a href="#" class="profile">
          Welcome! &nbsp;
          <span class="fw-bold">
            <?php
            $username = $_SESSION['username'];
            echo $username;
            ?>
          </span>
        </a>
      </div>
    </nav>
    <!-- NAVBAR -->
    <!-- MAIN -->
    <main>
      <!-- Task Listing with Filtering Options -->
      <div class="filter-options">
        <h3>Filter Tasks</h3>
        <form method="get">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="statusFilter">Status:</label>
                <select class="form-control" id="statusFilter" name="status">
                  <option <?= (isset($_GET['status']) && $_GET['status'] == 'All') ? "selected" : "" ?> value="All">All</option>
                  <option <?= (isset($_GET['status']) && $_GET['status'] == 'Pending') ? "selected" : "" ?> value="Pending">Pending</option>
                  <option <?= (isset($_GET['status']) && $_GET['status'] == 'In Progress') ? "selected" : "" ?> value="In Progress">In Progress</option>
                  <option <?= (isset($_GET['status']) && $_GET['status'] == 'Completed') ? "selected" : "" ?> value="Completed">Completed</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="dateFilter">Due Date:</label>
                <input type="date" class="form-control" id="dateFilter" name="dueDate" <?= (isset($_GET['dueDate']) && $_GET['dueDate'] != '') ? "value='" . $_GET['dueDate'] . "'" : "" ?>>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>&nbsp;</label>
                <button type="submit" class="btn mt-4 btn-primary">Apply Filters</button>
                <a href='index.php' class="btn mt-4 btn-danger">Reset Filters</a>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!-- Task Listing with Filtering Options -->
      <!-- CREATE TASKS -->
      <div class="text-end m-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modelId">
          Create Task
        </button>
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Create Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="post" action="index-backend.php">
                <div class="modal-body">
                  <!-- Title -->
                  <div class="mb-3">
                    <div class="text-start">
                      <label for="" class="form-label">Title</label>
                    </div>
                    <input type="text" class="form-control" name="title" id="" aria-describedby="helpId" placeholder="">
                  </div>
                  <!-- Title -->
                  <!-- Description -->
                  <div class="mb-3">
                    <div class="text-start">
                      <label for="" class="form-label">Description</label>
                    </div>
                    <input type="text" class="form-control" name="description" id="" aria-describedby="helpId" placeholder="">
                  </div>
                  <!-- Description -->
                  <!--Due Date -->
                  <div class="mb-3">
                    <div class="text-start">
                      <label for="" class="form-label">Due Date</label>
                    </div>
                    <input type="date" class="form-control" name="dueDate" id="" aria-describedby="helpId" placeholder="">
                  </div>
                  <!--Due Date -->
                  <!--Status -->
                  <div class="mb-3">
                    <div class="text-start">
                      <label for="" class="form-label">Status</label>
                    </div>
                    <!-- <input type="text" class="form-control" name="status" id="" aria-describedby="helpId" placeholder=""> -->
                    <select class="form-control" id="assignedUserFilter" name="status">
                      <option value="">All</option>
                      <option value="Pending">Pending</option>
                      <option value="In Progress">In Progress</option>
                      <option value="Completed">Completed</option>
                    </select>
                  </div>
                  <!--Status -->
                  <!-- Assigned User -->
                  <?php
                  $read_user = "SELECT * FROM `users` WHERE `isDeleted` = '0'";
                  $result = $mysqli->query($read_user);
                  ?>
                  <div class="mb-3">
                    <div class="text-start">
                      <label for="" class="form-label">Assigned User</label>
                    </div>
                    <select class="form-control" id="assignedUserFilter" name="assignedUser">
                      <option value="">All</option>
                      <?php
                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_object()) {
                          echo "<option value='" . $row->id . "'>" . $row->username . "</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <!-- Assigned User -->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="createTask" value="submit" class="btn btn-primary">Create Task</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Modal -->
      </div>
      <!-- CREATE TASKS -->
      <div class="table-responsive">
        <table class="table table-primary">
          <thead>
            <tr>
              <th scope="col">Sr.No</th>
              <th scope="col">Title</th>
              <th scope="col">Description</th>
              <th scope="col">Due Date</th>
              <th scope="col">Status</th>
              <th scope="col">Assigned User</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <!-- READ_USER [SELECT] -->
            <?php
            $search = "";
            if (isset($_GET['status']) && isset($_GET['dueDate'])) {
              $statusFilter = $_GET['status'];
              if ($statusFilter != '' && $statusFilter != 'All') {
                $search = "WHERE t.`status` = '$statusFilter'";
              }
              $dueDateFilter = $_GET['dueDate'];
              if ($dueDateFilter != '') {
                $search .= ($search != '') ? " AND t.`dueDate` = '$dueDateFilter' " : " WHERE t.`dueDate` = '$dueDateFilter' ";
              }
            }
            $read_user = "SELECT t.*,u.`username` FROM `task` AS t LEFT JOIN `users` AS u ON t.`assignUser` = u.`id` $search";
            $result = $mysqli->query($read_user);
            if ($result) {
              if ($result->num_rows > 0) {
                $i = 1;
                while ($row = $result->fetch_object()) {
            ?>
                  <!-- READ_USER [SELECT] -->
                  <tr class="">
                    <td><?= $i++ ?></td>
                    <td><?= $row->title ?></td>
                    <td><?= $row->description ?></td>
                    <td><?= $row->dueDate ?></td>
                    <td><?= $row->status ?></td>
                    <td><?= $row->username ?></td>
                    <td> <!-- Button trigger modal -->
                      <button name="editTask" type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editTask<?= $row->id ?>">
                        Edit Task
                      </button>
                      <!-- Modal -->
                      <!-- Edit Task Modal -->
                      <div class="modal fade" id="editTask<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Edit Task</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="index-backend.php">
                              <input type="hidden" name="id" value="<?= $row->id ?>">
                              <div class="modal-body">
                                <!-- Title -->
                                <div class="mb-3">
                                  <label for="editTitle" class="form-label">Title</label>
                                  <input type="text" class="form-control" id="editTitle" name="title" value="<?= $row->title ?>">
                                </div>
                                <!-- Description -->
                                <div class="mb-3">
                                  <label for="editDescription" class="form-label">Description</label>
                                  <input type="text" class="form-control" id="editDescription" name="description" value="<?= $row->description ?>">
                                </div>
                                <!-- Due Date -->
                                <div class="mb-3">
                                  <label for="editDueDate" class="form-label">Due Date</label>
                                  <input type="date" class="form-control" id="editDueDate" name="dueDate" value="<?= $row->dueDate ?>">
                                </div>
                                <!-- Status -->
                                <div class="mb-3">
                                  <label for="editStatus" class="form-label">Status</label>
                                  <select class="form-control" id="editStatus" name="status">
                                    <option value="Pending" <?= ($row->status == 'Pending') ? 'selected' : '' ?>>Pending</option>
                                    <option value="In Progress" <?= ($row->status == 'In Progress') ? 'selected' : '' ?>>In Progress</option>
                                    <option value="Completed" <?= ($row->status == 'Completed') ? 'selected' : '' ?>>Completed</option>
                                  </select>
                                </div>
                                <!-- Assigned User -->
                                <div class="mb-3">
                                  <label for="editAssignedUser" class="form-label">Assigned User</label>
                                  <select class="form-control" id="editAssignedUser" name="assignedUser">
                                    <?php
                                    $read_user = "SELECT * FROM `users` WHERE `isDeleted` = '0'";
                                    $result_user = $mysqli->query($read_user);
                                    if ($result_user->num_rows > 0) {
                                      while ($row_user = $result_user->fetch_object()) {
                                        $selected = ($row_user->id == $row->assignUser) ? 'selected' : '';
                                        echo "<option value='" . $row_user->id . "' $selected>" . $row_user->username . "</option>";
                                      }
                                    }
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" value="submitEditTask" class="btn btn-success" name="submitEditTask">Save changes</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </td>
                    <!-- DELETE -->
                    <td>
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTask<?= $row->id ?>">
                        Delete
                      </button>
                      <!-- Modal -->
                      <div class="modal fade" id="deleteTask<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Delete Task</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="index-backend.php">
                              <div class="modal-body">
                                <p>Are you sure you want to delete this Task?</p>
                                <input type="hidden" name="id" value="<?= $row->id ?>" id="">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button name="deleteTask" type="submit" class="btn btn-danger">Delete Task</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </td>
                    <!-- DELETE -->
                  </tr>
                <?php
                }
              } else { ?>
                <tr class="red">
                  <td colspan="9" class="text-center bg-danger">No Data Found</td>
                </tr>
            <?php
              }
            }  ?>
          </tbody>
        </table>
      </div>
    </main>
    <!-- MAIN -->
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- CONTENT -->
  <script src="script.js"></script>
</body>

</html>