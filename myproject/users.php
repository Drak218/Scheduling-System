<?php
include('header.php'); // Include the session and cookie handling logic

// Fetch user data from the database
$sql = "SELECT id, username, email, firstname, lastname, middlename, birthday, address, mobile FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">User Data</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
				<th>User Name</th>
				<th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Middle Name</th>
				<th>Birthday</th>
				<th>Address</th>
				<th>Mobile Number</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
					echo "<td>" . $row['username'] . "</td>";
					echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['firstname'] . "</td>";
                    echo "<td>" . $row['lastname'] . "</td>";
                    echo "<td>" . $row['middlename'] . "</td>";
					echo "<td>" . $row['birthday'] . "</td>";
					echo "<td>" . $row['address'] . "</td>";
					echo "<td>" . $row['mobile'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No users found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>