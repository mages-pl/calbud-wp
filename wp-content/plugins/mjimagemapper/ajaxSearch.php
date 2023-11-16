<?php
require_once("../../../wp-load.php");

//print_r($_POST['inwestycja']);

$atts = [
    'id'=>$_POST['inwestycja'],
    'view'=>$_POST['view']
];

echo imgmap_frontend_table($atts, $_POST, 'ajax');
exit();
