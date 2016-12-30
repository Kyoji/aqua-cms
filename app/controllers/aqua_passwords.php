<?php
/**
 * Classes and methods for handling and creating passwords
 *
 * @since 0.1
 * @author Daniel Owens
 */

$passwordhash = password_hash("password", PASSWORD_BCRYPT);
$passwordhash2 = password_hash('test', PASSWORD_DEFAULT);

echo $passwordhash."\n";
echo $passwordhash2."\n";

if( password_verify( 'test', $passwordhash ) ) {
    echo "true";
}

