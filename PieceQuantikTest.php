<?php


use PHPUnit\Framework\TestCase;

class PieceQuantikTest extends TestCase
{
    public function testInits()
    {
        $v = PieceQuantik::initVoid();
        $CuB = PieceQuantik::initBlackCube();
        $CoB = PieceQuantik::initBlackCone();
        $CyB = PieceQuantik::initBlackCylinder();
        $SpB = PieceQuantik::initBlackSphere();
        $CuW = PieceQuantik::initWhiteCube();
        $CoW = PieceQuantik::initWhiteCone();
        $CyW = PieceQuantik::initWhiteCylinder();
        $SpW = PieceQuantik::initWhiteSphere();
        $b = $v->__toString() == "(    )";
        $b &= $CuB->__toString() == "(Cu:B)";
        $b &= $CoB->__toString() == "(Co:B)";
        $b &= $CyB->__toString() == "(Cy:B)";
        $b &= $SpB->__toString() == "(Sp:B)";
        $b &= $CuW->__toString() == "(Cu:W)";
        $b &= $CoW->__toString() == "(Co:W)";
        $b &= $CyW->__toString() == "(Cy:W)";
        $b &= $SpW->__toString() == "(Sp:W)";
        assertEquals($b,true);
    }
}