<?php
require "PieceQuantik.php";

$pieceVide = PieceQuantik::initVoid();
$CuB = PieceQuantik::initBlackCube();
$CoB = PieceQuantik::initBlackCone();
$CyB = PieceQuantik::initBlackCylindre();
$SpB = PieceQuantik::initBlackSphere();
$CuW = PieceQuantik::initWhiteCube();
$CoW = PieceQuantik::initWhiteCone();
$CyW = PieceQuantik::initWhiteCylindre();
$SpW = PieceQuantik::initWhiteSphere();

echo $pieceVide->getForme();
echo $pieceVide->getCouleur();
echo $pieceVide;
echo $CuB;
echo $CoB;
echo $CyB;
echo $SpB;
echo $CuW;
echo $CoW;
echo $CyW;
echo $SpW;