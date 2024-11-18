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

// Default query to show all reports
$query = "SELECT * FROM reports";

// Check if search is performed
if (isset($_GET['search'])) {
    $search_name = $_GET['search'];
    $query = "SELECT * FROM reports WHERE patient_name LIKE '%$search_name%'";
}

// Fetch data from the database
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COVID-19 Test Reports</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>/* General Styles */
body {
    font-family: 'Poppins', sans-serif;
    background: #f5f7fa;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    min-height: 100vh;
}

.container {
    max-width: 900px;
    width: 100%;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    padding: 30px;
}

/* Header */
h1 {
    text-align: center;
    color: #007bff;
    margin-bottom: 20px;
    font-size: 28px;
}

/* Search Form */
.search-form {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.search-form input {
    width: 70%;
    padding: 10px;
    border-radius: 8px 0 0 8px;
    border: 1px solid #ddd;
    font-size: 16px;
}

.search-form button {
    padding: 10px 20px;
    background: #007bff;
    color: #fff;
    border: none;
    border-radius: 0 8px 8px 0;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
}

.search-form button:hover {
    background: #0056b3;
}

/* Table Styles */
#report_table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

#report_table th, #report_table td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

#report_table th {
    background: #007bff;
    color: #fff;
}

#report_table tr:hover {
    background: #f0f4ff;
}

/* Export Button */
.export-btn {
    padding: 8px 16px;
    background: #28a745;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
}

.export-btn:hover {
    background: #218838;
}

/* No Results Message */
.no-results {
    text-align: center;
    padding: 20px;
    background: #ffc107;
    border-radius: 8px;
    color: #856404;
    font-size: 18px;
}
</style>
</head>
<body>

<div class="container">
    <h1>COVID-19 Test Reports</h1>
    
    <!-- Search Form -->
    <form method="get" action="display_report.php" class="search-form">
        <input type="text" name="search" placeholder="🔍 Enter Patient Name" required>
        <button type="submit">Search</button>
    </form>
    
    <div id="report-list">
        <?php if ($result->num_rows > 0): ?>
            <table id="report_table">
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Test Result</th>
                        <th>Vaccination Suggestion</th>
                        <th>Report Date</th>
                        <th>Export</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['patient_name']; ?></td>
                            <td><?= $row['test_result']; ?></td>
                            <td><?= $row['vaccination_suggestion']; ?></td>
                            <td><?= $row['report_date']; ?></td>
                            <td><button class="export-btn" onclick='exportRowToPDF(<?= json_encode($row); ?>)'>Export to PDF</button></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-results">No reports found.</p>
        <?php endif; ?>
    </div>
</div>

<?php $conn->close(); ?>

<script>
    // Function to Export Data as PDF
    function exportRowToPDF(rowData) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Add Patient Details to PDF
        doc.text(`Patient Name: ${rowData.patient_name}`, 10, 10);
        doc.text(`Test Result: ${rowData.test_result}`, 10, 20);
        doc.text(`Vaccination Suggestion: ${rowData.vaccination_suggestion}`, 10, 30);
        doc.text(`Report Date: ${rowData.report_date}`, 10, 40);

        // Save the PDF with the Patient's Name
        doc.save(`${rowData.patient_name}_report.pdf`);
    }
</script>
</body>
</html>
