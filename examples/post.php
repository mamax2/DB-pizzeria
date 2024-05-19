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
        Nome: <input type="text" name="nome"><br>
        Cognome: <input type="text" name="nome"><br>
        <input type="submit" name="creaUtente">
    </form>
</body>

<?php
if (isset($_POST['creaUtente'])) {

    // Crea la connessione
    $conn = new mysqli("localhost", "username", "password", "myDB");

    $nome = $_POST['nome'];
    $cognome =  $_POST['cognome'];

    // Query SQL per selezionare dati
    $sql = "INSERT INTO Utenti(Nome, Cognome) VALUE('$nome', '$cognome')";
    $result = $conn->query($sql);

    echo "Nuovo Utente creato";

    $conn->close();
}
?>


</html>