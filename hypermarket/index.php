<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hypermarket Pricing Calculator</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Hypermarket Pricing Calculator</h1>
        <form method="post" action="">
            <?php for ($i = 1; $i <= 10; $i++): ?>
            <div class="product">
                <h2>Product <?php echo $i; ?></h2>
                <label for="buying_price<?php echo $i; ?>">Buying Price:</label>
                <input type="number" step="0.01" id="buying_price<?php echo $i; ?>" name="buying_price<?php echo $i; ?>" required><br>
                <label for="vat<?php echo $i; ?>">VAT (%):</label>
                <input type="number" step="0.01" id="vat<?php echo $i; ?>" name="vat<?php echo $i; ?>" required><br>
                <label for="expenses<?php echo $i; ?>">General Expenses (%):</label>
                <input type="number" step="0.01" id="expenses<?php echo $i; ?>" name="expenses<?php echo $i; ?>" required><br>
                <label for="profit<?php echo $i; ?>">Profit Margin (%):</label>
                <input type="number" step="0.01" id="profit<?php echo $i; ?>" name="profit<?php echo $i; ?>" required><br>
            </div>
            <?php endfor; ?>
            <input type="submit" name="calculate" value="Calculate Selling Prices">
        </form>
        
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['calculate'])) {
            echo '<h2>Results</h2>';
            echo '<table>';
            echo '<tr><th>Product</th><th>Selling Price</th></tr>';
            for ($i = 1; $i <= 10; $i++) {
                $buying_price = $_POST["buying_price$i"];
                $vat = $_POST["vat$i"];
                $expenses = $_POST["expenses$i"];
                $profit = $_POST["profit$i"];
                
                $vat_amount = $buying_price * ($vat / 100);
                $expenses_amount = $buying_price * ($expenses / 100);
                $profit_amount = $buying_price * ($profit / 100);
                
                $selling_price = $buying_price + $vat_amount + $expenses_amount + $profit_amount;
                
                echo "<tr><td>Product $i</td><td>" . number_format($selling_price, 2) . "</td></tr>";
            }
            echo '</table>';
        }
        ?>
    </div>
</body>
</html>
