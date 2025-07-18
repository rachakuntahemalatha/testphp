<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "sample";

$conn = mysqli_connect('localhost', 'root', '', 'sample');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch employees
$sql = "SELECT * FROM companies";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Companies List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
    }

    .sidebar {
      height: 100vh;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #343a40;
      color: white;
      padding-top: 1rem;
    }

    .sidebar a {
      color: #adb5bd;
      padding: 12px 20px;
      display: block;
      text-decoration: none;
    }

    .sidebar a:hover {
      background-color: #495057;
      color: white;
    }

    .content {
      margin-left: 250px;
      padding: 2rem;
    }
  </style>
</head>
<body>

  <?php include 'sidebarmenu.php'; ?>

  <!-- Main Content -->
  <div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Companies List</h2>
      <a href="add_employee.php" class="btn btn-primary">+ Add Employee</a>
    </div> 

    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-dark">
          <tr>
            <th>company_id</th>
            <th>company_name</th>
            <th>headquarters_state</th>
            <th>Actions</th>
          </tr>
        </thead>
         <?php if ($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['company_id']) ?></td>
              <td><?= htmlspecialchars($row['company_name']) ?></td>
              <td><?= htmlspecialchars($row['headquarters_state']) ?></td>
              <td>
              <a href="view_employee.php?id=<?= $row['company_id'] ?>" class="btn btn-sm btn-warning">View</a>
                <a href="edit_employee.php?id=<?= $row['company_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete_employee.php?id=<?= $row['company_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="6" class="text-center">No employees found.</td></tr>
        <?php endif; ?>
      </tbody>
      </table>
    </div>
  </div>

</body>
</html>
