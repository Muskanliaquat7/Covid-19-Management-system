<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Requests</title>
    <link rel="stylesheet" href="styles.css">
    <style>/* General Reset */
/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body and Layout */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
}

/* Admin Container */
.admin-container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 20px;
}

/* Header */
.admin-header {
    background-color: #007bff;
    color: white;
    padding: 15px;
    text-align: center;
    font-size: 20px;  /* Reduced size */
    font-weight: 600;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
}

/* Table Container */
.table-container {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    font-size: 14px;  /* Reduced size */
}

/* Table Headers */
th {
    padding: 10px;
    text-align: left;
    background-color: #007bff;
    color: white;
    font-size: 16px;  /* Reduced size */
    font-weight: 500;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

/* Table Cells */
td {
    padding: 10px;
    text-align: left;
    background-color: #f9f9f9;
    border-bottom: 1px solid #ddd;
    font-size: 14px;  /* Reduced size */
}

/* Action Buttons */
td a {
    padding: 6px 12px;
    text-decoration: none;
    border-radius: 5px;
    margin-right: 10px;
    transition: background-color 0.3s ease, transform 0.2s;
    font-weight: 600;
    font-size: 14px;  /* Reduced size */
}

/* Approve Button */
td a.approve-btn {
    background-color: #28a745;
    color: white;
}

td a.approve-btn:hover {
    background-color: #218838;
    transform: translateY(-2px);
}

/* Reject Button */
td a.reject-btn {
    background-color: #dc3545;
    color: white;
}

td a.reject-btn:hover {
    background-color: #c82333;
    transform: translateY(-2px);
}

/* No Data Found */
.no-data {
    text-align: center;
    font-size: 14px;  /* Reduced size */
    color: #666;
    padding: 15px 0;
    font-style: italic;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .admin-header {
        font-size: 22px;  /* Reduced size */
    }
    
    table, th, td {
        font-size: 12px;  /* Reduced size */
    }

    td a {
        padding: 5px 10px;
    }
}

</style>
    <!-- <link rel="stylesheet" href="styles.css"> -->
</head>
<body>
    <div class="admin-container">
        <header class="admin-header">
            <h1>Manage COVID-19 Test Requests</h1>
        </header>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Contact</th>
                        <th>City</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
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

                    // Fetch all pending requests
                    $sql = "SELECT * FROM requests WHERE status = 'Pending'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['patient_name'] . "</td>";
                            echo "<td>" . $row['contact'] . "</td>";
                            echo "<td>" . $row['city'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>
                                    <a href='update_status.php?id=" . $row['id'] . "&status=Approved' class='approve-btn'>Approve</a>
                                    <a href='update_status.php?id=" . $row['id'] . "&status=Rejected' class='reject-btn'>Reject</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='no-data'>No pending requests found.</td></tr>";
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
