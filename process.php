<?php
$servername = "localhost"; 
$username = "root"; 
$password = "password"; 
$dbname = "contact_form";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    
    if (empty($name) || empty($email) || empty($message)) {
        echo "Please fill in all fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO submissions (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
        
        if ($stmt->execute()) {
            echo "Thank you for your message, $name!";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
} else {
    echo "Please submit the form.";
}

$conn->close();
?>
