<?php
require "PieceQuantik.php";

$chaineTest = "";
$chainTestSep = "\n\n---------------  TEST SUIVANT ---------------\n\n";


// Initialisation de différentes pièces.
$pieceVide = PieceQuantik::initVoid();
$CuB = PieceQuantik::initBlackCube();
$CoB = PieceQuantik::initBlackCone();
$CyB = PieceQuantik::initBlackCylindre();
$SpB = PieceQuantik::initBlackSphere();
$CuW = PieceQuantik::initWhiteCube();
$CoW = PieceQuantik::initWhiteCone();
$CyW = PieceQuantik::initWhiteCylindre();
$SpW = PieceQuantik::initWhiteSphere();

echo "\nAffichage d'une pièce vide (Rapel, par défaut une pièce vide à une forme de constante VOID qui est égal à 0
ainsi qu'une couleur de constante WHITE égal à 0 également.\n";
echo "Ainsi, le résultat attendu est une forme et une couleur à 0.\n\n";
echo "Forme : " . $pieceVide->getForme() . "\n";
echo "Couleur : " . $pieceVide->getCouleur() . "\n";

$chaineTest .= ($pieceVide->getForme() == 0) ?  "\t-Test forme réussi\n" :  "\t-Test forme incorect\n";
$chaineTest .= ($pieceVide->getCouleur() == 0) ?  "\t-Test couleur réussi" :  "\t-Test couleur incorect\n";
echo $chaineTest;
$chaineTest = "";

echo "\nAffichage de la piece : \n";
echo $pieceVide;

echo $chainTestSep;


echo "Affichage des différentes pièces initalisées : \n";

echo $CuB;
echo $CoB;
echo $CyB;
echo $SpB;
echo $CuW;
echo $CoW;
echo $CyW;
echo $SpW . "\n";