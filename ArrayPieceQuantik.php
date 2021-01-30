<?php

include_once "PieceQuantik.php";
class ArrayPieceQuantik
{
    protected array $piecesQuantiks = array();
    protected int $taille;

    public function _construct() {
        $pieceQuantik = array();
        $taille = 0;
    }

    public function __toString() : String {
        $res = "[";
        for($i = 0; $i < $this->taille; $i++){
            if($i < $this->taille - 1){
                $res .= $this->piecesQuantiks[$i] . "; ";
            } else {
                $res .= $this->piecesQuantiks[$i] . "]";
            }
        }
        return $res;
    }

    public function getPieceQuantik(int $pos) : PieceQuantik {
        return $this->piecesQuantiks[$pos];
    }

    public function setPieceQuantik(int $pos, PieceQuantik $piece) {
        $this->piecesQuantiks[$pos] = $piece;
    }

    public function addPieceQuantik(PieceQuantik $piece) {
        $this->taille = array_push($this->piecesQuantiks, $piece);
    }

    public function removePieceQuantik(int $pos){
        if($pos >= 0 && $pos < $this->taille) {
            for ($i = $pos; $i < $this->taille - 1; $i++)
                $this->piecesQuantiks[$i] = $this->piecesQuantiks[$i + 1];
            array_pop($this->piecesQuantiks);
            $this->taille--;
        }
    }

    public function getTaille() : int {
        return $this->taille;
    }

    public static function initPiecesNoires() : ArrayPieceQuantik {
        $setNoir = new ArrayPieceQuantik();
        $setNoir->addPieceQuantik(PieceQuantik::initBlackCube());
        $setNoir->addPieceQuantik(PieceQuantik::initBlackCube());
        $setNoir->addPieceQuantik(PieceQuantik::initBlackCone());
        $setNoir->addPieceQuantik(PieceQuantik::initBlackCone());
        $setNoir->addPieceQuantik(PieceQuantik::initBlackCylindre());
        $setNoir->addPieceQuantik(PieceQuantik::initBlackCylindre());
        $setNoir->addPieceQuantik(PieceQuantik::initBlackSphere());
        $setNoir->addPieceQuantik(PieceQuantik::initBlackSphere());
        return $setNoir;
    }

    public static function initPiecesBlanches() : ArrayPieceQuantik {
        $setBlanc = new ArrayPieceQuantik();
        $setBlanc->addPieceQuantik(PieceQuantik::initWhiteCube());
        $setBlanc->addPieceQuantik(PieceQuantik::initWhiteCube());
        $setBlanc->addPieceQuantik(PieceQuantik::initWhiteCone());
        $setBlanc->addPieceQuantik(PieceQuantik::initWhiteCone());
        $setBlanc->addPieceQuantik(PieceQuantik::initWhiteCylindre());
        $setBlanc->addPieceQuantik(PieceQuantik::initWhiteCylindre());
        $setBlanc->addPieceQuantik(PieceQuantik::initWhiteSphere());
        $setBlanc->addPieceQuantik(PieceQuantik::initWhiteSphere());
        return $setBlanc;
    }
}