<!DOCTYPE html>
<html>

<head>
    <title>Esempio PHP con Trigger SQL per metodo UPDATE</title>
</head>

<body>
    <!-- 
        - "action" indica quale script richiamare quando si preme il pusante submit  ($_SERVER['PHP_SELF'] stampa il nome di questo file PHP)
        - "name" indica il nome dell'azione
    -->
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id" value="1">
        Nome: <input type="text" name="nome"><br>
        Cognome: <input type="text" name="nome"><br>
        <input type="submit" name="aggiornaUtente">
    </form>
</body>

<?php
if (isset($_POST['aggiornaUtente'])) {

    // Crea la connessione
    $conn = new mysqli("localhost", "username", "password", "myDB");

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cognome =  $_POST['cognome'];

    // Query SQL per selezionare dati
    $sql = "UPDATE Utenti SET Nome = '$nome', Cognome = '$cognome' WHERE IDUtente = $id";
    $result = $conn->query($sql);

    echo "Nuovo Utente creato";

    $conn->close();
}
?>


</html>