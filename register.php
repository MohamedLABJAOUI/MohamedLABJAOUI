<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Step 1: Capture form data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // Step 2: Validate input
    if (!empty($username) && !empty($email) && !empty($password)) {
        
        // Step 3: Connect to the database (Replace with your DB details)
        $conn = new mysqli('localhost', 'root', '', 'users_database');
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Step 4: Prepare and execute the SQL query
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        
        if ($stmt->execute()) {
            // Step 5: Redirect to welcome page or send email
            echo "Registration successful!";
            sendWelcomeEmail($email); // Call function to send the email
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Please fill in all required fields.";
    }
}

// Function to send welcome email
function sendWelcomeEmail($to) {
    $subject = "Welcome to Our Website!";
    $message = "Hi, \n\nThank you for registering with us. We're excited to have you on board!";
    $headers = "From: no-reply@yourwebsite.com";

    mail($to, $subject, $message, $headers);
}
?>
