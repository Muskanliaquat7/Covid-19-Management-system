<?php
include('db.php');

// Fetch data from database
$sql = "SELECT id, patient_name, contact, hospital_name, appointment_date, allergy, dob, vaccine, status FROM appointments";
$result = $conn->query($sql);

$appointments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
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
    <title>My Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Appointment</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th>
                    <th>Contact</th>
                    <th>Hospital Name</th>
                    <th>Appointment Date</th>
                    <th>Allergy</th>
                    <th>Date of Birth</th>
                    <th>Vaccine</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($appointments)): ?>
                    <?php foreach ($appointments as $appointment): ?>
                        <tr>
                            <td><?= htmlspecialchars($appointment['id']) ?></td>
                            <td><?= htmlspecialchars($appointment['patient_name']) ?></td>
                            <td><?= htmlspecialchars($appointment['contact']) ?></td>
                            <td><?= htmlspecialchars($appointment['hospital_name']) ?></td>
                            <td><?= htmlspecialchars($appointment['appointment_date']) ?></td>
                            <td><?= htmlspecialchars($appointment['allergy']) ?></td>
                            <td><?= htmlspecialchars($appointment['dob']) ?></td>
                            <td><?= htmlspecialchars($appointment['vaccine']) ?></td>
                            <td><?= htmlspecialchars($appointment['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" style="text-align: center;">No Appointments Found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
