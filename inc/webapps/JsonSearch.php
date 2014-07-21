<?php //Ce fichier sert au moteur de recherche. Des données y sont envoyées en AJAX, en retour sont renvoyées des données encodées en JSON.
//Les FirstName et LastName seront affichés dans les champs de suggestion dans la view contenant le moteur de recherche
use memberspace\model\User;

/* @var $oUser User */

$aUserFromSearch = array();

foreach($aSearchedUsers as $oUser)
{
    $aUserFromSearch[] = ['id' => $oUser->getLink(), 'label' => $oUser->getFirstName()." ".$oUser->getLastName(), 'value' => $oUser->getFirstName()];
}

echo json_encode($aUserFromSearch);


?>