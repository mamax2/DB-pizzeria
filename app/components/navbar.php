<?php
echo $_GET['redirect'];
switch ($_GET['redirect']) {
    case "menu":
        header('Location: http://localhost/menu');
        exit();
        break;
    case "sala":
        header('Location: http://localhost/sala');
        exit();
        break;
    case "cucina":
        header('Location: http://localhost/cucina');
        exit();
        break;
    case "magazzino":
        header('Location: http://localhost/magazzino');
        exit();
        break;
    case "login":
        header('Location: http://localhost/login');
        exit();
        break;
}
?>

<nav>
    <form method="get" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <input type="submit" name="redirect" value="menu">
        <input type="submit" name="redirect" value="sala">
        <input type="submit" name="redirect" value="cucina">
        <input type="submit" name="redirect" value="magazzino">
        <input type="submit" name="redirect" value="login">
    </form>
</nav>

<style>
    nav {
        display: flex;
        justify-content: space-around;
        flex-wrap: nowrap;
        padding: 20px;
    }

    button,
    input[type=submit] {
        padding: 5px 20px;
        border-radius: 9999px;
        border: none;
    }

    button:active {
        background: none;
    }
</style>