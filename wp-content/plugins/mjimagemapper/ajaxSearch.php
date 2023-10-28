<?php
require_once("../../../wp-load.php");


$atts = [
    'id'=>$_POST['inwestycja'],
    'view'=>$_POST['view']
];

echo imgmap_frontend_table($atts, $_POST, 'ajax');
exit();
