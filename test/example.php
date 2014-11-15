<?php

require '../vendor/autoload.php';

$cap = new SweetCaptcha\SweetCaptcha(
    'id',
    'key',
    'secret'
);

if (!empty($_POST['sckey']) && !empty($_POST['scvalue'])) {

    if ($cap->validate($_POST['sckey'], $_POST['scvalue'])) {
        echo "Ok";
    } else {
        echo "Fail";
    }

} else {

    echo '<form method="POST">';
    echo $cap->renderView();
    echo '<input type="submit"></form>';
}
