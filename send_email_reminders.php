<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../vendor/autoload.php';


// Get all due email reminders
$sql = "
    SELECT
        r.id AS reminder_id,
        r.invoice_id,
        r.channel,
        r.reminder_type,
        r.day_before,
        r.schedule_date,
        r.sent_at,

        i.description,
        i.amount,
        i.start_date,
        i.expire_date,

        c.fullname AS customer_name,
        c.email AS customer_email

    FROM reminder AS r

    INNER JOIN invoice AS i
        ON r.invoice_id = i.id

    INNER JOIN customers AS c
        ON i.customer_id = c.id

    WHERE r.channel = 'email'
      AND r.sent_at IS NULL
      AND r.schedule_date <= NOW()

    ORDER BY r.schedule_date ASC
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}


// Check if there are reminders
if (mysqli_num_rows($result) == 0) {
    echo "No email reminders are due.";
    exit;
}


// Process each reminder
while ($reminder = mysqli_fetch_assoc($result)) {

    $mail = new PHPMailer(true);

    try {

        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        // SECURITY CREADENTIALS
        $mail->Username = 'aloyce360joseph@gmail.com';
        $mail->Password = 'jxcm rksc jiks sumq';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;


        // Sender
        $mail->setFrom(
            'aloyce36joseph@gmail.com',
            'Client Invoice Reminder System'
        );


        // Customer
        $mail->addAddress(
            $reminder['customer_email'],
            $reminder['customer_name']
        );


        // Subject
        if ($reminder['day_before'] > 0) {

            $mail->Subject =
                'Invoice Expiry Reminder - ' .
                $reminder['day_before'] .
                ' Days Remaining';

        } else {

            $mail->Subject = 'Invoice Expiry Reminder - Due Today';
        }


        // Email format
        $mail->isHTML(true);


        // Protect values before putting them into HTML
        $customerName = htmlspecialchars(
            $reminder['customer_name']
        );

        $description = htmlspecialchars(
            $reminder['description']
        );

        $amount = number_format(
            $reminder['amount'],
            2
        );

        $expireDate = htmlspecialchars(
            $reminder['expire_date']
        );


        // Email message
        if ($reminder['day_before'] > 0) {

            $days = (int)$reminder['day_before'];

            $mail->Body = "
                <h2>Invoice Expiry Reminder</h2>

                <p>Hello <strong>{$customerName}</strong>,</p>

                <p>
                    This is a reminder that your invoice
                    <strong>{$description}</strong>
                    will expire in
                    <strong>{$days} days</strong>.
                </p>

                <p>
                    <strong>Invoice Amount:</strong>
                    {$amount}
                </p>

                <p>
                    <strong>Expiry Date:</strong>
                    {$expireDate}
                </p>

                <p>
                    Please make sure the invoice is handled
                    before the expiry date.
                </p>

                <p>Thank you.</p>
            ";

        } else {

            $mail->Body = "
                <h2>Invoice Expiry Reminder</h2>

                <p>Hello <strong>{$customerName}</strong>,</p>

                <p>
                    This is a reminder that your invoice
                    <strong>{$description}</strong>
                    expires today.
                </p>

                <p>
                    <strong>Invoice Amount:</strong>
                    {$amount}
                </p>

                <p>
                    <strong>Expiry Date:</strong>
                    {$expireDate}
                </p>

                <p>
                    Please take the necessary action.
                </p>

                <p>Thank you.</p>
            ";
        }


        // Send email
        $mail->send();


        // Mark reminder as sent
        $reminderId = (int)$reminder['reminder_id'];

        $updateSql = "
            UPDATE reminder
            SET sent_at = NOW()
            WHERE id = $reminderId
        ";

        if (mysqli_query($conn, $updateSql)) {

            echo "Email sent successfully to: "
                . htmlspecialchars($reminder['customer_email'])
                . "<br>";

        } else {

            echo "Email sent, but failed to update reminder ID "
                . $reminderId
                . ": "
                . mysqli_error($conn)
                . "<br>";
        }


    } catch (Exception $e) {

        echo "Email failed for "
            . htmlspecialchars($reminder['customer_email'])
            . ": "
            . htmlspecialchars($mail->ErrorInfo)
            . "<br>";
    }
}


mysqli_close($conn);

?>