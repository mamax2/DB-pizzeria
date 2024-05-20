<?php
if (isset($_GET['redirect']))
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
        position: sticky;
        justify-content: end;
        align-items: center;
        flex-wrap: nowrap;
        padding: 10px;
        top: 0;

        height: clamp(80px, 80px, 80px);

        background: rgba(255, 255, 255, 0.599);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.42);
    }
</style>