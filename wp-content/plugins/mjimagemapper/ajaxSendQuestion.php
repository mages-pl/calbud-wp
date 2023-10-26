<?php
require_once("../../../wp-load.php");


print_r($_POST);
echo "Zapytanie o lokal ".$_POST['lokal']." w inwestycji ".$_POST['inwestycja'];
echo $_POST['tresc'];
echo "Tra la la";
wp_mail('biuro@mages.pl', "Zapytanie o lokal ".$_POST['lokal']." w inwestycji ".$_POST['inwestycja'], $_POST['tresc']);

exit();
