<!DOCTYPE html>
<html>

<head>
    <title>Esempio PHP con Trigger SQL per metodo POST</title>
</head>

<body>
    <!-- 
        - "action" indica quale script richiamare quando si preme il pusante submit  ($_SERVER['PHP_SELF'] stampa il nome di questo file PHP)
        - "name" indica il nome dell'azione
    -->
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id" value="1">
        <input type="submit" name="eliminaUtente">
    </form>
</body>

<?php
if (isset($_POST['eliminaUtente'])) {

    // Crea la connessione
    $conn = new mysqli("localhost", "username", "password", "myDB");

    $id = $_POST["id"];

    // Query SQL per eliminare un'entità
    $sql = "DELETE FROM Utente WHERE IDUtente = $id";
    $result = $conn->query($sql);

    echo "Nuovo Utente creato";

    $conn->close();
}
?>


</html>