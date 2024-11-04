<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-card {
            background-color: #007BFF;
            color: white; 
        }
        .btn-custom {
            background-color: #28a745; 
            color: white;
        }
        .btn-custom:hover {
            background-color: #218838; 
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card login-card shadow p-4" style="width: 350px;">
            <h2 class="text-center mb-4">Login</h2>

            <?php
            if (isset($_GET['signup_success']) && $_GET['signup_success'] == 1) {
                echo "<div class='alert alert-success text-center'>Sign up successful! Please login.</div>";
            }
            ?>

            <?php
            session_start(); 
            include ('config.php');

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $sql = "SELECT * FROM users WHERE email = '$username'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $user = mysqli_fetch_assoc($result);

                    if (password_verify($password, $user['password'])) {
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['username'] = $user['email'];

                        setcookie("user_id", $user['id'], time() + 300, "/"); 

                        $last_login = date('Y-m-d H:i:s');
                        $update_sql = "UPDATE users SET last_login = '$last_login' WHERE id = " . $user['id'];
                        mysqli_query($conn, $update_sql);

                        header("Location: homepage.php");
                        exit();
                    } else {
                        echo "<div class='alert alert-danger text-center'>Invalid password.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger text-center'>User not found.</div>";
                }

                mysqli_close($conn);
            }
            ?>

            <form action="index1.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="email" name="username" id="username" class="form-control" placeholder="Enter your username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-custom w-100">Login</button>
            </form>
            <div class="text-center mt-3">
                <p>Don't have an account? <a href="signup.php" class="text-light">Sign up</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>