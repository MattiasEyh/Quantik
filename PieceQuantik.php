<?php


class PieceQuantik
{
    public const WHITE = 0;
    public const BLACK = 1;
    public const VOID = 0;
    public const CUBE = 1;
    public const CONE = 2;
    public const CYLINDRE = 3;
    public const SPHERE = 4;

    protected int $forme;
    protected int $couleur;

    private function __construct(int $forme, int $couleur){
        $this->forme = $forme;
        $this->couleur = $couleur;
    }

    public function getForme() : int {
        return $this->forme;
    }

    public function getCouleur() : int {
        return $this->couleur;
    }

    public function __toString() : string {
        $str = "";
        switch($this->forme) {
            case self::CUBE:
                $str = "(Cu:";
                break;
            case self::CONE:
                $str = "(Co:";
                break;
            case self::CYLINDRE:
                $str = "(Cy:";
                break;
            case self::SPHERE:
                $str = "(Sp:";
                break;
            default :
                $str = "(   ";
                break;
        }
        switch($this->couleur){
            case self::WHITE:
                $str .= "B)";
                break;
            case self::BLACK:
                $str .= "N)";
                break;
            default :
                $str .= " )";
                break;
        }
    }

    public static function initVoid(){
        return new PlateauQuantik(self::VOID, self::WHITE);
    }

    public static function initWhiteCube(){
        return new PlateauQuantik(self::CUBE, self::WHITE);
    }

    public static function initBlackCube(){
        return new PlateauQuantik(self::CUBE, self::BLACK);
    }

    public static function initWhiteCone(){
        return new PlateauQuantik(self::CONE, self::WHITE);
    }

    public static function initBlackCone(){
        return new PlateauQuantik(self::CONE, self::BLACK);
    }

    public static function initWhiteCylindre(){
        return new PlateauQuantik(self::CYLINDRE, self::WHITE);
    }

    public static function initBlackCylindre(){
        return new PlateauQuantik(self::CYLINDRE, self::BLACK);
    }

    public static function initWhiteSphere(){
        return new PlateauQuantik(self::SPHERE, self::WHITE);
    }

    public static function initBlackSphere(){
        return new PlateauQuantik(self::SPHERE, self::BLACK);
    }
}