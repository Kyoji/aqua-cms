<?php
/**
 * test login
 */

if( isset($_SERVER['HTTP_REFERER']) ) {
    //include( 'app/controllers/aqua_database.php' );
} else {
    print_r(Aqua\Aqua());
    ?>
    <form method="post" action="login">
        <input type="text" name="username">
        <input type="text" name="password">
        <button type="submit">Login</button>
    </form>
<?php
}
