<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="responsive-sidebar-dark-light-main\assets\css\styles.css">
    <style>
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<?php 
    include('responsive-sidebar-dark-light-main\index.html');
    ?>
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

            <div class="input-group">
                <label for="age">Allergy:</label>
                <input type="text" id="allergy" name="allergy" >
            </div>

            <div class="input-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>
            </div>

            <div class="input-group">
                <label for="vaccine">Vaccination Name:</label>
                <select id="vaccine" name="vaccine" required>
                    <option value="">Select Vaccine</option>
                    <option value="covishield">Covishield</option>
                    <option value="covaxin">Covaxin</option>
                    <option value="sputnik">Sputnik V</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">Book Appointment</button>
        </form>

        <?php
    include ("db.php");


        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $patient_name = $_POST['patient_name'];
            $contact = $_POST['contact'];
            $hospital_name = $_POST['hospital_name'];
            $appointment_date = $_POST['appointment_date'];
            $age = $_POST['allergy'];
            $dob = $_POST['dob'];
            $vaccine = $_POST['vaccine'];

            // Insert appointment details into database
            $sql = "INSERT INTO appointments (patient_name, contact, hospital_name, appointment_date,allergy,  dob, vaccine, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssiss", $patient_name, $contact, $hospital_name, $appointment_date, $allergy, $dob, $vaccine);

            // if ($stmt->execute()) {
            //     echo "<p class='success-message'>Your appointment has been booked successfully! Please wait for approval.</p>";
            // } else {
            //     echo "<p class='error-message'>Error: " . $stmt->error . "</p>";
            // }

            // Close connection
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
    <script src="responsive-sidebar-dark-light-main\assets\js\main.js"></script>

</body>
</html>