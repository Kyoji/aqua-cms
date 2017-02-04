<?php
/**
 * test login
 */
namespace Aqua;

$session = \Aqua\Session::getInstance();
$aqua = \Aqua\App::getInstance();

if( $session->__get("logged_in") ) 
{
    echo 'Welcome!';
    ?>
    <form method="post" action="/logout">
        <button type="submit">Logout</button>
    </form>
    <?php
} else {
    if( isset($_SERVER['HTTP_REFERER']) ) {
        //include( 'app/controllers/aqua_database.php' );
        if ( !$session->__get("logged_in") ) {
            print_r( $session->__get("logged_in") );
            $query = 'SELECT * FROM aqua_users WHERE user_name=\'' . $_POST['username'] . "'";
            $inputPass = $_POST['password'];
            $user = $aqua->database->query($query);
            if (password_verify($inputPass, $user[0]['user_password']))
                $session->__set("logged_in", true);
            echo "logged in!";
            ?>
            <form method="post" action="/logout">
                <button type="submit">Logout</button>
            </form>
            <?php
        } 
    } else {
        ?>
        <form method="post" action="login">
            <input type="text" name="username">
            <input type="text" name="password">
            <button type="submit">Login</button>
        </form>
    <?php
    }
}