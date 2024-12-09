<?php
// Database connection
include('db.php');

// Initialize variables
$patient_name = '';
$results = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the patient name from the form
    $patient_name = $conn->real_escape_string($_POST['patient_name']);
    
    // Fetch test results
    $sql = "SELECT * FROM test_results WHERE patient_name = '$patient_name'";
    $query_result = $conn->query($sql);

    if ($query_result->num_rows > 0) {
        $results = $query_result->fetch_assoc();
    } else {
        $results = null; // No results found
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View COVID-19 Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .results {
            margin-top: 20px;
            padding: 10px;
            background: #e8f5e9;
            border-left: 4px solid #4caf50;
        }
        .results p {
            margin: 5px 0;
        }
        .no-results {
            margin-top: 20px;
            padding: 10px;
            background: #ffebee;
            border-left: 4px solid #f44336;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>View COVID-19 Test Results</h1>
        <form method="POST">
            <input type="text" name="patient_name" placeholder="Enter your name" value="<?= htmlspecialchars($patient_name) ?>" required>
            <button type="submit">View Results</button>
        </form>
        
        <?php if ($results): ?>
            <div class="results">
                <h2>Results for <?= htmlspecialchars($results['patient_name']) ?>:</h2>
                <p><strong>Test Date:</strong> <?= htmlspecialchars($results['test_date']) ?></p>
                <p><strong>Test Result:</strong> <?= htmlspecialchars($results['test_result']) ?></p>
                <p><strong>Vaccination Suggestion:</strong> <?= htmlspecialchars($results['vaccination_suggestion']) ?></p>
            </div>
        <?php elseif ($patient_name): ?>
            <div class="no-results">
                <p>No results found for <strong><?= htmlspecialchars($patient_name) ?></strong>.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
