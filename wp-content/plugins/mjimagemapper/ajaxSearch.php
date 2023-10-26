<?php
require_once("../../../wp-load.php");

//require_once('imagemapper.php');

//echo "TEST 123";
$atts = ['id'=>$_POST['inwestycja']];
//$_POST = [];
echo imgmap_frontend_table($atts, $_POST, 'ajax');
exit();
// $atts=array();
//         $atts['id'] = @$_POST['inwestycja'];
//         return imgmap_frontend_table($atts, $_POST, 'search');e