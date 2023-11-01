<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoices</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <h1>Invoices</h1>
    <hr>

    <table>
        <thead>
            <tr>
                <th class="center">Invoice #</th>
                <th class="center">Amount</th>
                <th class="center">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($invoices as $invoice): ?>
            <tr>
                <td class="center"><?= $invoice['invoice_number'] ?></td>
                <td class="center"><?= (new \NumberFormatter('en_US', NumberFormatter::CURRENCY))->format($invoice['amount'], 2) ?></td>
                <td class="<?= \App\Enums\InvoiceStatus::tryFrom($invoice['status'])->color()->value ?>">
                    <?= \App\Enums\InvoiceStatus::tryFrom($invoice['status'])->toString() ?>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>