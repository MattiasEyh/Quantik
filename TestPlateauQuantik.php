<?php

require_once "PlateauQuantik.php";

$plateauVide = new PlateauQuantik();
$plateauRemplis = new PlateauQuantik();

$chainTestSep = "\n\n---------------  TEST SUIVANT ---------------\n\n";

$plateauRemplis->setPiece(0, 0, PieceQuantik::initBlackSphere());
$plateauRemplis->setPiece(0, 1, PieceQuantik::initBlackCone());
$plateauRemplis->setPiece(0, 2, PieceQuantik::initWhiteSphere());
$plateauRemplis->setPiece(0, 3, PieceQuantik::initBlackCube());

$plateauRemplis->setPiece(1, 0, PieceQuantik::initWhiteCone());
$plateauRemplis->setPiece(1, 1, PieceQuantik::initBlackCone());
$plateauRemplis->setPiece(1, 2, PieceQuantik::initWhiteCube());
$plateauRemplis->setPiece(1, 3, PieceQuantik::initWhiteCylindre());

$plateauRemplis->setPiece(2, 0, PieceQuantik::initBlackCone());
$plateauRemplis->setPiece(2, 1, PieceQuantik::initBlackCone());
$plateauRemplis->setPiece(2, 2, PieceQuantik::initBlackCone());
$plateauRemplis->setPiece(2, 3, PieceQuantik::initBlackCone());

$plateauRemplis->setPiece(3, 0, PieceQuantik::initBlackCone());
$plateauRemplis->setPiece(3, 1, PieceQuantik::initBlackCone());
$plateauRemplis->setPiece(3, 2, PieceQuantik::initBlackCone());
$plateauRemplis->setPiece(3, 3, PieceQuantik::initBlackCone());


echo "Affichage du tableau rempli : \n";

echo $plateauRemplis;

echo "\nAffichage du tableau vide : \n";

echo $plateauVide;

echo $chainTestSep;

echo "getters de 0, 0 : \n";

echo $plateauRemplis->getPiece(0,0);

echo "\nSetter : Ajout d'un cylindre blanc en 0 0 :\n";

echo $plateauRemplis->setPiece(0,0, PieceQuantik::initWhiteCylindre());
echo $plateauRemplis->getPiece(0,0). "\n";

echo "\n";

echo $chainTestSep;

echo "Re-affichage du tableau rempli : \n\n";

echo $plateauRemplis;

echo "Affichage de print_r pour les méthodes:\n";
echo "GetRow de 0 : \n";
print_r($plateauRemplis->getRow(0));

echo "\nGetCol de 0 : \n";
print_r($plateauRemplis->getCol(0));

echo "\nGetCorner au nord ouest : \n";
print_r($plateauRemplis->getCorner(PlateauQuantik::NW));