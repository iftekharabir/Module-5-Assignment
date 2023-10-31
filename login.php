<?php
include 'settings.php';
include 'functions.php';
$message = '';

if(isset($_SESSION['loged_in'])&& $_SESSION['loged_in'] == true){
    header('Location: index.php');
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    

    if (empty($username) || empty($password)) {
        $message = 'Please fill all fields!';
    } else {
        $allUsers = getAllUser($file_path);
        
        if (!empty($allUsers)) {
            $user = findUser($username, $allUsers);
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user;
                    $_SESSION['loged_in'] = true;

                    header('Location: index.php');
                } else {
                    $message = 'Invalid password!';
                }
            } else {
                $message = 'User not found!';
            }
            
        } else {
            $message = 'No User In Record';
        }
    }
}






?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h2>Login</h2>
                <?php if ($message): ?>
                <div class="alert alert-danger">
                    <?php echo $message; ?>
                </div>
                <?php endif; ?>
                <form action="login.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Email Address</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
</body>

</html>