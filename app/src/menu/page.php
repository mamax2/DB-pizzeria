<?php

try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PSWD, DB_NAME);
} catch (Exception $e) {
    echo $e->getMessage();
}

$sql = "SELECT 
                Menu.IDProdotto,
                Prodotti.Nome AS Prodotto,
                Menu.Quantita,
                UnitaMisura.Nome AS Unita,
                CategorieMenu.Nome AS Categoria,
                Menu.Prezzo
            FROM 
                Menu
            INNER JOIN Prodotti
            ON Menu.IDProdotto=Prodotti.IDProdotto
            INNER JOIN UnitaMisura
            ON Menu.IDUnita = UnitaMisura.IDUnita
            INNER JOIN CategorieMenu
            ON Menu.IDCategoria = CategorieMenu.IDCategoria";

$result = $conn->query($sql);

$results = [];
if ($result && $result->num_rows > 0) {
    // output dei dati di ogni riga
    while ($row = $result->fetch_assoc()) {
        array_push($results, $row);
    }
}
$conn->close();
?>

<main>
    <?php if (!empty($results)) : ?>
        <ul>
            <?php foreach ($results as $x) : ?>

                <article>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($x["IDProdotto"]); ?>">
                    <div class="header">
                        <h4>
                            <span><?php echo htmlspecialchars($x["Prodotto"]); ?></span>
                            x
                            <span><?php echo htmlspecialchars($x["Quantita"]) . htmlspecialchars($x["Unita"]); ?></span>
                        </h4>
                        <h4><?php echo htmlspecialchars($x["Prezzo"]); ?>€</h4>
                    </div>
                    <button class="interaction">•••</button>
                </article>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <div>
            Menu Vuoto
        </div>
    <?php endif; ?>
</main>

<aside>
    Modifica campo menu
</aside>