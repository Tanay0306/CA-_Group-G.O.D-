<?php
session_start();
include "lib/connection.php";
include "lib/generate-token.php";
include "lib/verify-token.php";

if (isset($_POST['submit'])) {
    // Verify the CSRF token
    if (!verify_token($_POST['csrf_token'])) {
        die("Invalid CSRF token");
    }

    // Get user input
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Check if username meets the requirements
    if (!preg_match('/^[a-zA-Z]+$/', $name)) {
        die("Invalid username. Username should only contain alphabets.");
    }

    // Check if username already exists in database
    $checkquery = $conn->prepare("SELECT * FROM users WHERE f_name = ?");
    $checkquery->bind_param("s", $name);
    $checkquery->execute();
    $result = $checkquery->get_result();
    if ($result->num_rows > 0) {
        die("Username already exists.");
    }


    // Check if password meets the requirements
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d\s])[^\s\'";:<>]*$/', $pass)) {
        die("Invalid password. Password should have at least one lowercase, one uppercase, one number, and one special character .");
    }

    // Hash the password using bcrypt
    $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);

    // Protect against SQL injection attacks
    $regquery = $conn->prepare("INSERT INTO users (f_name, email, pass) VALUES (?, ?, ?)");
    $regquery->bind_param("sss", $name, $email, $hashed_pass);
    $regquery->execute();

    if ($regquery) {
        header("location: login1.php.php");
        exit;
    } else {
        $error = "Registration failed";
    }
}

// Generate a new CSRF token
$token = generate_token();
$_SESSION['csrf_token'] = $token;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>cse411</title>
</head>
<body class="bg-gradient-primary">

<div class="container">
    <!-- Outer Row -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <!-- CSRF token input field -->
        <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                   id="exampleInputName" name="name"
                                                   placeholder="Full Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                   id="exampleInputEmail" aria-describedby="emailHelp"
                                                   name="email"
                                                   placeholder="Email Address">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                   id="exampleInputPassword" placeholder="Password" name="password">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                                Register
                                            </button>
                                        </div>
                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

    </div>
</body>

                    </div>
                </div>
            </div>
        </form>
        <script>
            
