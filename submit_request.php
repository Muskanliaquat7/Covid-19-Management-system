<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "covid_hospital_search";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if required fields are set and not empty
    if (isset($_POST['patient_name']) && isset($_POST['contact']) && isset($_POST['city'])) {
        $patient_name = $_POST['patient_name'];
        $contact = $_POST['contact'];
        $city = $_POST['city'];

        // Ensure data is not empty
        if (!empty($patient_name) && !empty($contact) && !empty($city)) {
            // Insert request into database
            $sql = "INSERT INTO requests (patient_name, contact, city) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $patient_name, $contact, $city);

            if ($stmt->execute()) {
                echo "<div class='message-box success'>✅ Your request has been submitted successfully! Please wait for approval.</div>";
                echo "<a href='index.html' class='back-button'>🔙 Go Back</a>";
            } else {
                echo "<div class='message-box error'>❌ Error: " . $stmt->error . "</div>";
            }

            // Close connection
            $stmt->close();
        } else {
            echo "<div class='message-box error'>⚠️ All fields are required.</div>";
        }
    } else {
        echo "<div class='message-box error'>⚠️ Form data is missing.</div>";
    }
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title><style>
        /* General Styling */
body {
    font-family: 'Poppins', Arial, sans-serif;
    background-color: #f0f2f5;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    padding: 20px;
}

/* Message Box Styling */
.message-box {
    width: 100%;
    max-width: 600px;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Success Message */
.success {
    background-color: #e6ffe6;
    border-left: 5px solid #28a745;
    color: #2c662d;
}

/* Error Message */
.error {
    background-color: #ffe6e6;
    border-left: 5px solid #dc3545;
    color: #721c24;
}

/* Back Button Styling */
.back-button {
    display: inline-block;
    padding: 12px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 123, 255, 0.2);
    transition: all 0.3s ease;
}

/* Back Button Hover Effect */
.back-button:hover {
    background-color: #0056b3;
    box-shadow: 0 6px 10px rgba(0, 123, 255, 0.4);
    transform: translateY(-2px);
}

/* Responsive Design */
@media (max-width: 480px) {
    .message-box {
        font-size: 16px;
        padding: 15px;
    }
    .back-button {
        padding: 10px 16px;
        font-size: 14px;
    }
}

    </style>
</head>
<body>
    
</body>
</html>