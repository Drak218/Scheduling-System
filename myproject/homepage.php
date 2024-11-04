<?php
include('header.php');

// Fetch user info from the database
$user_id = $_SESSION['user_id']; // or use $user_id from the cookie if session is not set
$sql = "SELECT firstname, lastname FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .header {
            background-color: #007bff; 
            color: white; 
            padding: 15px;
        }
        .header .navbar-brand {
            color: white; 
        }
        .header .navbar-text {
            color: white; 
        }
        .sidebar {
            height: 100vh;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .sidebar a {
            display: block;
            padding: 10px;
            margin: 5px 0;
            color: #333;
            text-decoration: none;
            border-radius: 10px; 
        }
        .sidebar a:hover {
            background-color: #007bff;
            color: white;
        }
        .dashboard-card {
            border-radius: 10px; 
            text-align: left;
            padding: 20px;
            margin-bottom: 20px;
        }
        .dashboard-card-blue {
            background-color: #007bff; 
            color: white;
        }
        .dashboard-card-green {
            background-color: #28a745; 
            color: white;
        }
        .dashboard-card-yellow {
            background-color: #ffc107; 
            color: white; 
        }
        .gray-line {
            border-bottom: 1px solid #d3d3d3;
            margin-bottom: 20px;
        }
        .footer {
            background-color: black; 
            color: white; 
            padding: 15px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg header">
        <div class="container-fluid">
            <span class="navbar-brand">Schedule Management System</span>
            <div class="d-flex">
                <span class="navbar-text me-3">
                    <?php echo $user['firstname'] . ' ' . $user['lastname']; ?>
                </span>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-3">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <nav class="nav flex-column">
                    <a class="nav-link" href="homepage.php">Home</a>
                    <a class="nav-link" href="class.php">Class</a>
                    <a class="nav-link" href="schedule.php">Schedule</a>
                    <a class="nav-link" href="teacher.php">Teacher</a>
                    <a class="nav-link" href="homepage.php?section=users">Users</a> 
                    <a class="nav-link" href="maintenance.php">Maintenance</a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 mt-4" id="mainContent">
                <?php
                if (isset($_GET['section']) && $_GET['section'] == 'users') {
                    echo '<div class="d-flex justify-content-between align-items-center mb-3">';
                    echo '<h3>User Database</h3>';
                    echo '<input type="text" id="userSearch" class="form-control" placeholder="Search users..." style="width: 250px;">';
                    echo '</div>';

                    echo '<button id="addUserBtn" class="btn btn-success mb-3">Add User</button>';

                    $sql = "SELECT id, username, email, firstname, lastname, middlename, birthday, address, mobile FROM users";
                    $result = $conn->query($sql);

                    echo '<table class="table table-bordered">';
                    echo '<thead><tr><th>ID</th><th>User Name</th><th>Email</th><th>First Name</th><th>Last Name</th><th>Middle Name</th><th>Birthday</th><th>Address</th><th>Mobile</th></tr></thead>';
                    echo '<tbody id="userTable">';

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['firstname']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['lastname']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['middlename']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['birthday']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['mobile']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo '<tr><td colspan="9" class="text-center">No users found.</td></tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<h3>Dashboard Overview</h3>';
                    echo '<div class="gray-line"></div>';
                    echo '<div class="row mt-3">';
                    echo '<div class="col-md-4"><div class="dashboard-card dashboard-card-blue"><h4>Classes</h4><p>3</p></div></div>';
                    echo '<div class="col-md-4"><div class="dashboard-card dashboard-card-green"><h4>Teaching Load</h4><p>8</p></div></div>';
                    echo '<div class="col-md-4"><div class="dashboard-card dashboard-card-yellow"><h4>Pending Tasks</h4><p>15</p></div></div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <footer class="footer text-center">
        © 2024 Drak's Schedule Management System
    </footer>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
               
            </div>
            <div class="modal-body">
				<form id="addUserForm">
					<div class="form-group">
					<label for="username">Username</label>
						<input type="text" class="form-control" id="username" name="username" required>
					</div>
					<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" name="email" required>
					</div>
					<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" required>
					</div>
					<div class="form-group">
					<label for="firstname">First Name</label>
					<input type="text" class="form-control" id="firstname" name="firstname" required>
					</div>
					<div class="form-group">
					<label for="lastname">Last Name</label>
					<input type="text" class="form-control" id="lastname" name="lastname" required>
					</div>
					<div class="form-group">
					<label for="middlename">Middle Name</label>
					<input type="text" class="form-control" id="middlename" name="middlename">
					</div>
					<div class="form-group">
					<label for="birthday">Birthday</label>
					<input type="date" class="form-control" id="birthday" name="birthday" required>
					</div>
					<div class="form-group">
					<label for="address">Address</label>
					<input type="text" class="form-control" id="address" name="address" required>
					</div>
					<div class="form-group">
					<label for="mobile">Mobile Number</label>
					<input type="text" class="form-control" id="mobile" name="mobile" required>
					</div>
					<button type="submit" class="btn btn-primary">Add User</button>
				</form>
            </div>
        </div>
    </div>
</div>

<!-- Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="notificationMessage">
                <!-- Message will be injected here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery for Filtering and Adding Users -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Filtering users in the table
        $('#userSearch').on('keyup', function() {
            var value = $(this).val();
            $.ajax({
                url: 'search_users.php',
                type: 'GET',
                data: { search: value },
                success: function(data) {
                    $('#userTable').html(data);
                }
            });
        });

        // Show the Add User modal
        $('#addUserBtn').on('click', function() {
            $('#addUserModal').modal('show');
        });

        // Adding a user through the form
        $('#addUserForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            // Serialize the form data, including the password
            $.ajax({
                url: 'add_users.php',
                type: 'POST',
                data: $(this).serialize(), // This should now include the password field
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    // Show success or error message in the notification modal
                    if (response.success) {
                        $('#notificationMessage').text('User added successfully!');
                    } else {
                        $('#notificationMessage').text('Error adding user: ' + response.message);
                    }
                    $('#notificationModal').modal('show'); // Show the modal

                    // Fetch and update the user table
                    loadUserTable();
                    $('#addUserModal').modal('hide'); // Hide the add user modal after successful addition
                    $('#addUserForm')[0].reset(); // Reset the form
                },
                error: function() {
                    $('#notificationMessage').text('An error occurred while adding the user.');
                    $('#notificationModal').modal('show'); // Show the modal
                }
            });
        });

        // Function to load and display users
        function loadUserTable() {
            $.ajax({
                url: 'search_users.php', // Ensure this is your user fetching script
                type: 'GET',
                success: function(data) {
                    $('#userTable').html(data);
                }
            });
        }
    });
</script>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>