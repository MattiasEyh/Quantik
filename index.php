<?php

include_once "QuantikUtil.php";
include_once "ArrayPieceQuantik.php";
include_once "PieceQuantik.php";

//session_start();

$plateauRemplis = new PlateauQuantik();
$plateauRemplis->setPiece(0, 0, PieceQuantik::initWhiteSphere());
$plateauRemplis->setPiece(0, 1, PieceQuantik::initBlackCylindre());
$plateauRemplis->setPiece(1, 0, PieceQuantik::initWhiteCone());
$plateauRemplis->setPiece(3, 1, PieceQuantik::initBlackCube());

$plateauRemplis->setPiece(2, 0, PieceQuantik::initBlackCube());
$plateauRemplis->setPiece(2, 1, PieceQuantik::initWhiteCube());
$plateauRemplis->setPiece(2, 2, PieceQuantik::initWhiteSphere());
$plateauRemplis->setPiece(2, 3, PieceQuantik::initBlackSphere());

$plateauRemplis->setPiece(3, 0, PieceQuantik::initBlackCube());
$plateauRemplis->setPiece(3, 1, PieceQuantik::initWhiteSphere());
$plateauRemplis->setPiece(3, 2, PieceQuantik::initWhiteCylindre());
$plateauRemplis->setPiece(3, 3, PieceQuantik::initBlackCone());


$ar = ArrayPieceQuantik::initPiecesBlanches();
$piece = PieceQuantik::initWhiteCylindre();
$aq = new ActionQuantik($plateauRemplis);


echo(QuantikUtil::getDebutHTML());

echo("<h1> TP de programation web </h1><h2>Arthur Mittelstaedt, Mattias Eyherabide</h2><h3>Quantik</h3><br>");

echo("<p>Affichage d'une ArrayPieceQuantik de pièces blanches :</p></br>".$ar."<br><hr><br>");

echo("<p>GetDivPiecesDisponibles</p>");
echo(QuantikUtil::getDivPiecesDisponibles($ar)."<br><hr>");

echo("<p>getFormSelectionPiece</p>");
echo(QuantikUtil::getFormSelectionPiece($ar));

echo("<p>GetDivPlateauQuantik</p>");
echo(QuantikUtil::getDivPlateauQuantik($plateauRemplis) . "<br><hr>");

echo("<p>GetFormPlateauQuantik</p>");
echo(QuantikUtil::getFormPlateauQuantik($plateauRemplis, $piece) . "<br><hr>");

echo("<p>Test ComboWin</p></br><p>Test non-Legit (ligne 2)</p>");
if ($aq->isRowWin(2) == false)
    echo("Test Réussi (false)");
else
    echo("Test failed (true)");

echo("<p>Test ComboWin</p></br><p>Test Legit (ligne 3)</p>");
if ($aq->isRowWin(3))
    echo("Test Réussi (true)");
else
    echo("Test failed (false)");

echo(QuantikUtil::getFinHTML());

?>
