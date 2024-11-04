<?php
include('config.php');

$search = $_GET['search'] ?? '';

// Prepare search query with wildcard for partial matches
$sql = "SELECT id, username, email, firstname, lastname, middlename, birthday, address, mobile 
        FROM users 
        WHERE firstname LIKE ? 
           OR lastname LIKE ? 
           OR middlename LIKE ? 
           OR id LIKE ? 
           OR username LIKE ? 
           OR email LIKE ?
		   OR birthday LIKE ? 
           OR address LIKE ? 
           OR mobile LIKE ?";
$stmt = $conn->prepare($sql);
$search_param = "%" . $search . "%"; // This allows for partial matching
$stmt->bind_param("sssssssss", $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param, $search_param);
$stmt->execute();
$result = $stmt->get_result();

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
    echo '</tbody></table>';
} else {
    echo "<tr><td colspan='9' class='text-center'>No users found.</td></tr>";
}
?>