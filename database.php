<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "client_invoice_reminder_system"
);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

