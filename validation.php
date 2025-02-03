<?php
include_once('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if fields exist in the POST data
    $uname = isset($_POST['uname']) ? trim($_POST['uname']) : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    $conf = isset($_POST['passw']) ? $_POST['passw'] : '';
    $Email = isset($_POST['email']) ? trim($_POST['email']) : '';

    $errors = [];

    // Validate username
    if (empty($uname)) {
        $errors[] = "Username is required.";
    }

    // Validate email
    if (empty($Email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL) || substr($Email, -10) !== '@gmail.com') {
        $errors[] = "Email must be a valid Gmail address.";
    }

    // Validate password
    if (empty($pass)) {
        $errors[] = "Password is required.";
    } elseif (strlen($pass) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    } elseif ($pass !== $conf) {
        $errors[] = "Passwords do not match.";
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // If no errors, insert the user into the database
    if (empty($errors)) {
        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $uname, $pass, $Email);
            if ($stmt->execute()) {
                header("Location: login.php?registration=success");
            } else {
                echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}

?>
