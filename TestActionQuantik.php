<?php

require_once "ActionQuantik.php";
require_once "PlateauQuantik.php";


$plateauRemplis = new PlateauQuantik();

$chaineTestSep = "\n\n---------------  TEST SUIVANT ---------------\n\n";
$chaineTest = "";

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


$ActionQuantik = new ActionQuantik($plateauRemplis);

echo "\nAffichage de l'ActionQuantik : \n";

echo $ActionQuantik;

echo $chaineTestSep;

echo "Nouveau Action Quantik vide : \n";

$ActionQuantik2 = new ActionQuantik(new PlateauQuantik());

echo "\nAffichage : \n";

echo $ActionQuantik2;

echo $chaineTestSep;

echo "\nAjout de pieces..\n";

$ActionQuantik2->posePiece(0,0, PieceQuantik::initWhiteCylindre());
$ActionQuantik2->posePiece(0,1, PieceQuantik::initWhiteCube());
$ActionQuantik2->posePiece(0,2, PieceQuantik::initWhiteCone());
$ActionQuantik2->posePiece(0,3, PieceQuantik::initWhiteSphere());

echo $ActionQuantik2;

echo "\nUne ligne gagnante ! Test : \n";

$chaineTest .= ($ActionQuantik2->isRowWin(0) == true) ?  "\t-Test réussi\n" :  "\t-Test incorect\n";

echo $chaineTest;

echo $chaineTestSep;

echo "\nAjout d'une colonne gagnante : \n";

$ActionQuantik2->posePiece(1, 1, PieceQuantik::initWhiteCone());
$ActionQuantik2->posePiece(2, 1, PieceQuantik::initBlackSphere());
$ActionQuantik2->posePiece(3, 1, PieceQuantik::initBlackCylindre());


echo $ActionQuantik2;

echo "\nUne colonne gagnante ! (1) Test : \n";

$chaineTest = "";
$chaineTest .= ($ActionQuantik2->isColWin(1) == true) ?  "\t-Test réussi\n" :  "\t-Test incorect\n";
echo $chaineTest;
echo "\nTest avec un colonne Perdante (0) :\n";

$chaineTest = "";
$chaineTest .= ($ActionQuantik2->isColWin(0) == false) ?  "\t-Test réussi\n" :  "\t-Test incorect\n";

echo $chaineTest;

echo $chaineTestSep;

echo "\nAjout d'un angle gagnante : \n";

$ActionQuantik2->posePiece(3, 0, PieceQuantik::initWhiteCube());
$ActionQuantik2->posePiece(2, 0, PieceQuantik::initWhiteCone());

echo $ActionQuantik2;

echo "\nUn angle gagnant ! (SW) Test : \n";

$chaineTest = "";
$chaineTest .= ($ActionQuantik2->isCornerWin(PlateauQuantik::SW) == true) ?  "\t-Test réussi\n" :  "\t-Test incorect\n";
echo $chaineTest;

echo "\nTest avec un angle perdant : \n";

$chaineTest = "";
$chaineTest .= ($ActionQuantik2->isCornerWin(PlateauQuantik::SE) == false) ?  "\t-Test réussi\n" :  "\t-Test incorect\n";
echo $chaineTest;
