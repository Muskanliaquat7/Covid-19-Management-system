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

// Get the 'id' and 'status' from the URL
$id = $_GET['id'];
$status = $_GET['status'];

// Update the status in the database
$sql = "UPDATE requests SET status = '$status' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    // Redirect back to the admin panel
    header("Location: admin.php");
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Status Update</title>
    <link rel="stylesheet" href="styles.css">
    <style>/* Reset default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Set a modern font and smooth transition */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f7f6;
    color: #333;
    line-height: 1.6;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Container for the page */
.container {
    background-color: white;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
    text-align: center;
}

/* Header style */
.header h1 {
    font-size: 2rem;
    color: #5c6bc0;
    margin-bottom: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Style for result container */
.result-container {
    margin-top: 1rem;
}

/* Style for status messages */
.status-message {
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 500;
}

/* Success message style */
.status-message.success {
    background-color: #c8e6c9;
    color: #388e3c;
    border-left: 5px solid #388e3c;
}

/* Error message style */
.status-message.error {
    background-color: #ffebee;
    color: #d32f2f;
    border-left: 5px solid #d32f2f;
}

/* Back link style */
.back-link {
    text-decoration: none;
    color: #5c6bc0;
    font-weight: 600;
    padding: 10px 15px;
    border: 2px solid #5c6bc0;
    border-radius: 4px;
    display: inline-block;
    margin-top: 20px;
    transition: all 0.3s ease;
}

/* Hover effect for the back link */
.back-link:hover {
    background-color: #5c6bc0;
    color: white;
    transform: translateY(-2px);
}
</style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Appointment Status Update</h1>
        </header>

        <div class="result-container">
            <?php
            if ($stmt->execute()) {
                echo "<div class='status-message success'>";
                echo "Appointment " . $status . " successfully.";
                echo "</div>";
            } else {
                echo "<div class='status-message error'>";
                echo "Error: " . $stmt->error;
                echo "</div>";
            }

            // Provide a link back to the admin panel
            echo "<a href='admin.php' class='back-link'>Go Back</a>";
                ?>

        </div>
    </div>
</body>
</html>

<?php
// Close connection
$stmt->close();
$conn->close();
?>
