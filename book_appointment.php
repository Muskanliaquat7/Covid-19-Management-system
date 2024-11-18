<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Book Your Appointment</h2>
        <form method="POST" action="">
            <div class="input-group">
                <label for="patient_name">Patient Name:</label>
                <input type="text" id="patient_name" name="patient_name" required>
            </div>

            <div class="input-group">
                <label for="contact">Contact Number:</label>
                <input type="text" id="contact" name="contact" required>
            </div>

            <div class="input-group">
                <label for="hospital_name">Hospital Name:</label>
                <input type="text" id="hospital_name" name="hospital_name" required>
            </div>

            <div class="input-group">
                <label for="appointment_date">Appointment Date:</label>
                <input type="date" id="appointment_date" name="appointment_date" required>
            </div>

            <button type="submit" class="submit-btn">Book Appointment</button>
        </form>

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

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $patient_name = $_POST['patient_name'];
            $contact = $_POST['contact'];
            $hospital_name = $_POST['hospital_name'];
            $appointment_date = $_POST['appointment_date'];

            // Insert appointment details into database
            $sql = "INSERT INTO appointments (patient_name, contact, hospital_name, appointment_date, status) VALUES (?, ?, ?, ?, 'Pending')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $patient_name, $contact, $hospital_name, $appointment_date);

            if ($stmt->execute()) {
                echo "<p class='success-message'>Your appointment has been booked successfully! Please wait for approval.</p>";
            } else {
                echo "<p class='error-message'>Error: " . $stmt->error . "</p>";
            }

            // Close connection
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
