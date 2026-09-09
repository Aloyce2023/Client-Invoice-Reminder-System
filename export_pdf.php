```php
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'database.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Get reminder data
$sql = "
    SELECT
        r.id AS reminder_id,
        r.reminder_type,
        r.day_before,
        r.channel,
        r.schedule_date,
        r.sent_at,

        i.description,
        i.amount,
        i.expire_date,

        c.fullname AS customer_name,
        c.email AS customer_email

    FROM reminder AS r

    INNER JOIN invoice AS i
        ON r.invoice_id = i.id

    INNER JOIN customers AS c
        ON i.customer_id = c.id

    ORDER BY r.schedule_date ASC
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// HTML for PDF
$html = '
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<style>

@page {
    margin: 20px;
}

body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 8px;
}

h1 {
    text-align: center;
    font-size: 16px;
    margin-bottom: 15px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background-color: #eeeeee;
    font-weight: bold;
}

th, td {
    border: 1px solid #555555;
    padding: 4px;
}

th {
    text-align: center;
}

.center {
    text-align: center;
}

.amount {
    text-align: right;
}

</style>

</head>

<body>

<h1>CLIENT INVOICE REMINDER REPORT</h1>

<table>

<thead>

<tr>
    <th>S/N</th>
    <th>Customer</th>
    <th>Email</th>
    <th>Invoice</th>
    <th>Amount</th>
    <th>Expiry Date</th>
    <th>Reminder</th>
    <th>Days Before</th>
    <th>Channel</th>
    <th>Schedule Date</th>
    <th>Status</th>
</tr>

</thead>

<tbody>
';

$sn = 1;

while ($row = mysqli_fetch_assoc($result)) {

    $status = !empty($row['sent_at'])
        ? 'Sent'
        : 'Pending';

    $customer = htmlspecialchars(
        $row['customer_name'],
        ENT_QUOTES,
        'UTF-8'
    );

    $email = htmlspecialchars(
        $row['customer_email'],
        ENT_QUOTES,
        'UTF-8'
    );

    $description = htmlspecialchars(
        $row['description'],
        ENT_QUOTES,
        'UTF-8'
    );

    $reminderType = htmlspecialchars(
        $row['reminder_type'],
        ENT_QUOTES,
        'UTF-8'
    );

    $channel = htmlspecialchars(
        $row['channel'],
        ENT_QUOTES,
        'UTF-8'
    );

    $expireDate = htmlspecialchars(
        $row['expire_date'],
        ENT_QUOTES,
        'UTF-8'
    );

    $scheduleDate = htmlspecialchars(
        $row['schedule_date'],
        ENT_QUOTES,
        'UTF-8'
    );

    $amount = number_format(
        (float)$row['amount'],
        2
    );

    $dayBefore = htmlspecialchars(
        $row['day_before'],
        ENT_QUOTES,
        'UTF-8'
    );

    $html .= '
    <tr>

        <td class="center">' . $sn . '</td>

        <td>' . $customer . '</td>

        <td>' . $email . '</td>

        <td>' . $description . '</td>

        <td class="amount">' . $amount . '</td>

        <td>' . $expireDate . '</td>

        <td>' . $reminderType . '</td>

        <td class="center">' . $dayBefore . '</td>

        <td class="center">' . $channel . '</td>

        <td>' . $scheduleDate . '</td>

        <td class="center">' . $status . '</td>

    </tr>
    ';

    $sn++;
}

$html .= '

</tbody>

</table>

</body>
</html>
';

// Create PDF
$options = new Options();
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

// Download PDF
$dompdf->stream(
    'client_invoice_reminder_report.pdf',
    [
        'Attachment' => true
    ]
);

mysqli_close($conn);

exit;
?>
```
