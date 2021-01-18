<?php


class PieceQuantik
{
    // Constantes représantant les couleurs possibles pour une pièce
    public const WHITE = 0;
    public const BLACK = 1;
    // Constantes représantant les formes possibles pour une pièce
    public const VOID = 0; // Pièce vide (case innocupée)
    public const CUBE = 1;
    public const CONE = 2;
    public const CYLINDRE = 3;
    public const SPHERE = 4;

    /**
     * $forme : forme de la pièce
     * @access protected
     * @var int
     */
    protected int $forme;

    /**
     * $couleur : couleur de la pièce
     * @access protected
     * @var int
     */
    protected int $couleur;

    /**
     * Constructeur
     * Les valeurs de $forme et couleur doivent être celles des constantes
     * de la classe
     * @access private
     * @param $forme forme de la pièce
     * @param $couelur couleur de la pièce
     */
    private function __construct(int $forme, int $couleur){
        $this->forme = $forme;
        $this->couleur = $couleur;
    }

    /**
     * méthode getForme
     * @access public
     * @return $this->forme
     */
    public function getForme() : int {
        return $this->forme;
    }

    /**
     * méthode getCouleur
     * @access public
     * @return $this->couleur
     */
    public function getCouleur() : int {
        return $this->couleur;
    }

    /**
     * toString
     * représentation de la pièce sous la forme "(Fr:C)
     * @access public
     * @return string
     * (Fr abréviation de la forme et C abréviation de la couleur)
     */
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
                $str = "(    )";
                return $str;
                break;
        }
        switch($this->couleur){
            case self::WHITE:
                $str .= "B)";
                break;
            case self::BLACK:
                $str .= "N)";
                break;
        }
        return $str;
    }

    /**
     * méthode initVoid
     * initialise et renvoie une nouvelle pièce vide (par défault de couleur blanche)
     * @access public
     * @static
     * @return PieceQuantik
     */
    public static function initVoid() : PieceQuantik {
        return new PieceQuantik(self::VOID, self::WHITE);
    }

    /**
     * méthode initWhiteCube
     * initialise et renvoie une nouvelle pièce (cube blanc)
     * @access public
     * @static
     * @return PieceQuantik
     */
    public static function initWhiteCube() : PieceQuantik {
        return new PieceQuantik(self::CUBE, self::WHITE);
    }

    /**
     * méthode initBlackCube
     * initialise et renvoie une nouvelle pièce (cube noir)
     * @access public
     * @static
     * @return PieceQuantik
     */
    public static function initBlackCube() : PieceQuantik {
        return new PieceQuantik(self::CUBE, self::BLACK);
    }

    /**
     * méthode initWhiteCone
     * initialise et renvoie une nouvelle pièce (cone blanc)
     * @access public
     * @static
     * @return PieceQuantik
     */
    public static function initWhiteCone() : PieceQuantik {
        return new PieceQuantik(self::CONE, self::WHITE);
    }

    /**
     * méthode initBlackCone
     * initialise et renvoie une nouvelle pièce (cone noir)
     * @access public
     * @static
     * @return PieceQuantik
     */
    public static function initBlackCone() : PieceQuantik {
        return new PieceQuantik(self::CONE, self::BLACK);
    }

    /**
     * méthode initWhiteCylindre
     * initialise et renvoie une nouvelle pièce (cylindre blanc)
     * @access public
     * @static
     * @return PieceQuantik
     */
    public static function initWhiteCylindre() : PieceQuantik {
        return new PieceQuantik(self::CYLINDRE, self::WHITE);
    }

    /**
     * méthode initBlackCylindre
     * initialise et renvoie une nouvelle pièce (cylindre noir)
     * @access public
     * @static
     * @return PieceQuantik
     */
    public static function initBlackCylindre() : PieceQuantik {
        return new PieceQuantik(self::CYLINDRE, self::BLACK);
    }

    /**
     * méthode initWhiteSphere
     * initialise et renvoie une nouvelle pièce (sphère blanche)
     * @access public
     * @static
     * @return PieceQuantik
     */
    public static function initWhiteSphere() : PieceQuantik {
        return new PieceQuantik(self::SPHERE, self::WHITE);
    }

    /**
     * méthode initBlackSphere
     * initialise et renvoie une nouvelle pièce (sphère noire)
     * @access public
     * @static
     * @return PieceQuantik
     */
    public static function initBlackSphere() : PieceQuantik {
        return new PieceQuantik(self::SPHERE, self::BLACK);
    }
}