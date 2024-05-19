<!DOCTYPE html>
<html>

<head>
    <title>Esempio PHP con Trigger SQL con tutte le funzionalità</title>
</head>

<?php
// Crea la connessione
$conn = new mysqli("localhost", "username", "password", "myDB");

$sql = "SELECT IDUtente, Nome, Cognome FROM Utenti";
$result = $conn->query($sql);

$results = [];
if ($result->num_rows > 0) {
    // output dei dati di ogni riga
    while ($row = $result->fetch_assoc()) {
        array_push($results, $row);
    }
}

$conn->close();
?>


<body>
    <? if (!empty($result)) : ?>
        <? foreach ($results as $x) : ?>
            <form method="POST" action="<? echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="id" value="<? $x['IDUtente']; ?>">
                Nome: <input type=" text" name="nome" value="<? $x['Nome']; ?>"><br>
                Cognome: <input type="text" name="cognome" value="<? $x['Cognome']; ?>"><br>
                <input type="submit" name="aggiornaUtente">
                <input type="submit" name="eliminaUtente">
            </form>
        <? endforeach; ?>
    <? else : ?>
        <div>
            Nessun Utente esistente
        </div>
    <? endif; ?>

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