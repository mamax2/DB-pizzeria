<?php
include '../constants.php';

if (!defined('DB_HOST') || !defined('DB_USER') || !defined('DB_PSWD') || !defined('DB_NAME')) {
    die("Errore: costanti di connessione non definite correttamente. Controlla che nella cartella app/ sia presente il file constants.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Pizzeria</title>
    <link rel="stylesheet" href="../global.css">

    <link rel="apple-touch-icon" sizes="180x180" href="../assets/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/icons/favicon-16x16.png">
    <link rel="manifest" href="../assets/icons/site.webmanifest">
    <link rel="mask-icon" href="../assets/icons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="theme-color" content="#ffffff">
</head>

<body>
    <?php include '../components/navbar.php'; ?>

    <?php
    // Ottieni il percorso richiesto
    $request = $_SERVER['REQUEST_URI'];

    // Rimuovi eventuali query string
    $request = explode('?', $request)[0];

    // Rimuovi eventuali slash iniziali o finali
    $request = trim($request, '/');

    // Determina il percorso del file
    $filepath = __DIR__ . '/' . $request . '/page.php';

    // Verifica se il file esiste e includilo, altrimenti mostra un errore 404
    if (file_exists($filepath)) {
        include $filepath;
    } else {
        http_response_code(404);
        echo "404 $filepath Not Found";
    }

    ?>
</body>

</html>