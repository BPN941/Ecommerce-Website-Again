<?php 

session_start();
// Check if the user is logged in
if (isset($_SESSION['email'])) {
    header("Location: homepage.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Create Account</h1>
            <p>Please fill in the details to create your account.</p>
            <form action="validation.php" method="POST">
                <label for="uname">Username</label>
                <input type="text" id="uname" name="uname" placeholder="Enter your username" required>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                
                <label for="pass">Password</label>
                <input type="password" id="pass" name="pass" placeholder="Enter your password" required>
                
                <label for="passw">Confirm Password</label>
                <input type="password" id="passw" name="passw" placeholder="Re-enter your password" required>
            
                <button type="submit" class="signup-btn">Sign Up</button>
            </form>
            
        </div>
    </div>
</body>
</html>
