<!DOCTYPE html>
<html>
<head>
    <title>Simple Lending System</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px;
        }
        .container {
            background: lightgray;
            padding: 20px;
            width: 400px;
            margin: auto;
            border-radius: 8px;
        }
        input {
            width: 95%;
            padding: 8px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        select {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
        }
        button {
            background: #aea5a5ff;
            display: block;
            width: 70%;
            padding: 10px;
            margin: 15px auto;
        }
        .result {
            background: #b6cebaff;
            padding: 10px;
            margin-top: 15px;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Simple Lending System</h2>

    <form method="post">
        <label>Loan Amount (₱500 - ₱50,000)</label>
        <input type="number" name="amount" min="500" max="50000" required>

        <label>Loan Term</label>
        <select name="months" required>
            <option value="1">1 Month</option>
            <option value="3">3 Months</option>
            <option value="6">6 Months</option>
            <option value="9">9 Months</option>
            <option value="12">12 Months</option>
            <option value="24">24 Months</option>
        </select>

        <button type="submit" name="compute">COMPUTE LOAN</button>
    </form>

<?php
if (isset($_POST['compute'])) {

    $loan = $_POST['amount'];
    $months = $_POST['months'];

    if ($loan < 500 || $loan > 50000) {
        echo "<p style='color:red;'>Invalid loan amount.</p>";
        exit;
    }

    $rate = 0.02; // 2% monthly interest

    // Loan formula
    $monthlyPayment = $loan * ($rate * pow(1 + $rate, $months)) / (pow(1 + $rate, $months) - 1);

    $totalPayment = $monthlyPayment * $months;
    $totalInterest = $totalPayment - $loan;
    $monthlyInterest = $totalInterest / $months;

    echo "<div class='result'>";
    echo "<p><strong>YOUR LOAN AMOUNT:</strong> ₱" . number_format($loan, 2) . "</p>";
    echo "<p><strong>For:</strong> $months Month(s)</p>";
    echo "<hr>";
    echo "<p><strong>Monthly Interest:</strong> ₱" . number_format($monthlyInterest, 2) . "</p>";
    echo "<p><strong>Total Interest:</strong> ₱" . number_format($totalInterest, 2) . "</p>";
    echo "<p><strong>Total Amount to Pay:</strong> ₱" . number_format($totalPayment, 2) . "</p>";
    echo "<p><strong>Payment per Month:</strong> ₱" . number_format($monthlyPayment, 2) . "</p>";
    echo "</div>";
}
?>

</div>

</body>
</html>
