<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>TaskManager</title>

    <!-- Preconnect for fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Tailwind CSS (output) -->
    <link href="<?php echo APP_URL; ?>/public/css/output.css" rel="stylesheet">

    <!-- Lucide Icons (CDN for now) -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="font-body antialiased bg-background text-foreground">