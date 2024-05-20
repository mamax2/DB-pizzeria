<?php
if (isset($_POST['eliminaMenu'])) {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PSWD, DB_NAME);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    $idMenu = $_POST['idMenu'];

    $sql = "DELETE FROM Menu WHERE IDMenu=$idMenu";

    $result = $conn->query($sql);

    $conn->close();
}
?>

<?php

try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PSWD, DB_NAME);
} catch (Exception $e) {
    echo $e->getMessage();
}

$sql = "SELECT
            m.IDMenu,
            m.IDProdotto,
            p.Nome AS ProdottoNome,
            up.IDUnita,
            m.Quantita AS ProdottoQuantita,
            up.Nome AS ProdottoUnita,
            m.Prezzo,
            cm.IDCategoria,
            cm.Nome AS CategoriaNome,
            pp.IDIngrediente AS IDIngrediente,
            ip.Nome AS IngredienteNome,
            pp.Quantita AS IngredienteQuantita
        FROM
            Menu m
        INNER JOIN CategorieMenu cm 
            ON m.IDCategoria = cm.IDCategoria
        INNER JOIN Prodotti p 
            ON m.IDProdotto = p.IDProdotto
        LEFT JOIN Prodotto_Contiene_Prodotto pp 
            ON p.IDProdotto = pp.IDProdotto
        LEFT JOIN Prodotti ip 
            ON pp.IDIngrediente = ip.IDProdotto
        LEFT JOIN UnitaMisura up 
            ON m.IDUnita = up.IDUnita";

$result = $conn->query($sql);

$menu = [];
if ($result && $result->num_rows > 0) {
    // output dei dati di ogni riga
    while ($row = $result->fetch_assoc()) {
        $categoria_id = $row['IDCategoria'];
        $categoria_nome = $row['CategoriaNome'];
        $menu_id = $row['IDMenu'];
        $prodotto_nome = $row['ProdottoNome'];
        $ingrediente_id = $row['IDIngrediente'];
        $ingrediente_nome = $row['IngredienteNome'];

        // Se la categoria non esiste, creala
        if (!isset($menu[$categoria_id])) {
            $menu[$categoria_id] = [
                'Nome' => $categoria_nome,
                'Prodotti' => []
            ];
        }

        // Se il prodotto non esiste nella categoria, crealo
        if (!isset($menu[$categoria_id]['Prodotti'][$menu_id])) {
            $menu[$categoria_id]['Prodotti'][$menu_id] = [
                'Nome' => $prodotto_nome,
                'Quantita' => $row['ProdottoQuantita'],
                'Prezzo' => $row['Prezzo'],
                'Unita' => $row['ProdottoUnita'],
                'Ingredienti' => []
            ];
        }

        // Aggiungi l'ingrediente al prodotto
        if (isset($ingrediente_id))
            $menu[$categoria_id]['Prodotti'][$menu_id]['Ingredienti'][$ingrediente_id] = [
                'Nome' => $ingrediente_nome,
                'Quantita' => $row['IngredienteQuantita'],
                'Unita' => ''
            ];
    }
}
$conn->close();

?>

<main>
    <?php if (!empty($menu)) : ?>
        <ul>
            <?php foreach ($menu as $idCategoria => $categoria) : ?>
                <h2><?php echo $categoria['Nome']; ?></h2>
                <?php foreach ($categoria['Prodotti'] as $idMenu => $prodotto) : ?>
                    <article>
                        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            <input type="hidden" name="idMenu" value="<?php echo htmlspecialchars($idMenu); ?>">
                            <div class="header">
                                <h4>
                                    <span><?php echo htmlspecialchars($prodotto["Nome"]); ?></span>
                                    x
                                    <span><?php echo htmlspecialchars($prodotto["Quantita"]) . htmlspecialchars($prodotto["Unita"]); ?></span>
                                </h4>
                                <h4><?php echo htmlspecialchars($prodotto["Prezzo"]); ?>€</h4>
                            </div>
                            <?php if (!empty($prodotto['Ingredienti'])) : ?>
                                <div class="body">
                                    <?php
                                    foreach ($prodotto['Ingredienti'] as $idIngrediente => $ingrediente) {
                                        echo $ingrediente['Nome'] . ', ';
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                            <button class="interaction">•••</button>
                            <input type="submit" name="eliminaMenu" value="Elimina">
                        </form>
                    </article>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <div>
            Menu Vuoto
        </div>
    <?php endif; ?>
</main>

<aside>
    <form id="editMenu">
        <input type="hidden" id="edit-id" value="">
        <label for=" edit-prodotto">Prodotto</label>
        <input type="text" id="edit-prodotto">
        <label for="edit-quantita">Quantità</label>
        <input type="text" id="edit-quantita">
        <label for="edit-unita">Unità</label>
        <input type="text" id="edit-unita">
        <label for="edit-categoria">Prezzo</label>
        <input type="text" id="edit-categoria">
        <label for="edit-prezzo">Categoria</label>
        <input type="text" id="edit-prezzo">
        <button type="submit">Salva</button>
    </form>
</aside>