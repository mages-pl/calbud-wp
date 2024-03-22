<?php
require_once("../../../wp-load.php");

//print_r($_POST['inwestycja']);

$atts = [
    'typ_wyszukiwarki' => $_POST['typ_wyszukiwarki'], // Typ: [mieszkanie, lokal_uslugowy, miejsce_postojowe]
    'id'=>$_POST['inwestycja'],
    'view'=>$_POST['view'] // Typ widoku  czy w widoku pojedynczej inwestycji czy w sekcji /deweloper (z lista innych inwestycji i miniatur)
];

echo imgmap_frontend_table($atts, $_POST, 'ajax');
exit();
