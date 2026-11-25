<?php
$cart = [
    ["name" => "USB-C Cable", "price" => 250.00, "quantity" => 2],
    ["name" => "Wireless Mouse", "price" => 850.00, "quantity" => 1],
    ["name" => "Notebook", "price" => 120.00, "quantity" => 3],
];

$subtotal = 0.0;
foreach ($cart as $item) {
    $subtotal += (float)$item["price"] * (int)$item["quantity"];
}

$vatRate = 0.12;
$vat = $subtotal * $vatRate;
$grandTotal = $subtotal + $vat;
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <h3>Shopping Cart Summary</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Line Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart as $item):
                $lineTotal = (float)$item["price"] * (int)$item["quantity"];
            ?>
            <tr>
                <td><?= htmlspecialchars($item["name"]) ?></td>
                <td><?= number_format((float)$item["price"], 2) ?></td>
                <td><?= (int)$item["quantity"] ?></td>
                <td><?= number_format($lineTotal, 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><strong>Subtotal</strong></td>
                <td><strong><?= number_format($subtotal, 2) ?></strong></td>
            </tr>
            <tr>
                <td colspan="3"><strong>VAT (12%)</strong></td>
                <td><?= number_format($vat, 2) ?></td>
            </tr>
            <tr>
                <td colspan="3"><strong>Grand Total</strong></td>
                <td><strong><?= number_format($grandTotal, 2) ?></strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>