<?php

include_once "QuantikUtil.php";
include_once "ArrayPieceQuantik.php";
include_once "PieceQuantik.php";

session_start();

$plateauRemplis = new PlateauQuantik();
$plateauRemplis->setPiece(0, 0, PieceQuantik::initBlackSphere());
$plateauRemplis->setPiece(0, 1, PieceQuantik::initBlackCone());
$plateauRemplis->setPiece(0, 2, PieceQuantik::initWhiteSphere());

$ar = ArrayPieceQuantik::initPiecesBlanches();

echo(QuantikUtil::getDebutHTML());

echo("<h1> TP de programation web </h1><h2>Arthur Mittelstaedt, Mattias Eyherabide</h2><h3>Quantik</h3><br>");

echo("<p>Affichage d'une ArrayPieceQuantik de pièces blanches :</p></br>".$ar."<br><hr><br>");

echo("<p>GetDivPiecesDisponibles</p>");
echo(QuantikUtil::getDivPiecesDisponibles($ar)."<br><hr>");

echo("<p>getFormSelectionPiece</p>");
echo(QuantikUtil::getFormSelectionPiece($ar));

echo("<p>GetFormPlateauQuantik</p>");
echo(QuantikUtil::getFormPlateauQuantik($plateauRemplis, $plateauRemplis->getPiece(0,1))."<br><hr>");

echo(QuantikUtil::getFinHTML());

?>
