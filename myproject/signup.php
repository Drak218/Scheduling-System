<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .signup-card {
            background-color: #007BFF;
            width: 350px;
            padding: 20px;
        }
        .form-control {
            height: 30px; 
            font-size: 14px; 
        }
        .form-label {
            font-size: 13px; 
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
            height: 35px; 
            font-size: 14px; 
        }
        .btn-custom:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card signup-card shadow">
            <h2 class="text-center mb-3">Sign Up</h2>

            <form action="signupform.php" method="POST">
                <div class="mb-2">
                    <label for="email" class="form-label">Username (Email)</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <div class="mb-2">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter your last name" required>
                </div>
                <div class="mb-2">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter your first name" required>
                </div>
                <div class="mb-2">
                    <label for="middlename" class="form-label">Middle Name</label>
                    <input type="text" name="middlename" id="middlename" class="form-control" placeholder="Enter your middle name" required>
                </div>
                <div class="mb-2">
                    <label for="birthday" class="form-label">Birthday</label>
                    <input type="date" name="birthday" id="birthday" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Enter your address" required>
                </div>
                <div class="mb-2">
                    <label for="mobile" class="form-label">Mobile Number</label>
                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter your mobile number" required>
                </div>
                <button type="submit" class="btn btn-custom w-100">Sign Up</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>