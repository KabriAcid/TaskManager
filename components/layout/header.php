<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>TaskManager</title>

    <!-- Preconnect for fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (output) -->
    <link href="<?php echo APP_URL; ?>/public/css/output.css" rel="stylesheet">

    <!-- Lucide Icons (CDN for now) -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="font-body antialiased">