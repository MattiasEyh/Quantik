
<?php

require_once "PieceQuantik.php";

class PlateauQuantik
{
    const NBROWS = 4;
    const NBCOLS = 4;
    const NW = 0;
    const NE = 2;
    const SW = 3;
    const SE = 4;

    /**
     * Tableau représentant le plateau
     * @var array
     */
    protected array $cases;

    /**
     * Constructeur de PlateauQuantik.
     * Initialise un plateau de jeu vide
     */
    public function __construct(){
        $this->cases = array();

        for ($i=0; $i < self::NBROWS; $i++) {
            $this->cases[$i] = array();
            for ($j = 0; $j < self::NBCOLS; $j++)
                $this->cases[$i][$j] = PieceQuantik::initVoid();
        }
    }

    /**
     * Afficheur de la classe PlateauQuantik
     * @return string
     */
    public function __toString(): string {
        $str = "";
        for ($i = 0; $i < self::NBROWS; $i++) {
            for ($j = 0; $j < self::NBCOLS; $j++) {
                $str .= $this->cases[$i][$j];
            }
            $str .= "\n";
        }

        return $str;
    }

    /**
     * Getter de l'attribut "cases".
     * @return array
     */public  function getCases(): array{
    return $this->cases;
}


    /**
     * Getter qui permet d'accéder à la pièce du plateau
     * se trouvant ligne $rowNum et colonne $colNum.
     * @param int $rowNum
     * @param int $colNum
     * @return PieceQuantik
     */
    public function getPiece(int $rowNum, int $colNum) : PieceQuantik{
        return $this->cases[$rowNum][$colNum];
    }

    /**
     * Setter permetant de placer une pièce $p à dans la case ligne $rowNum
     * et colonne $colNum
     * @param int $rowNum
     * @param int $colNum
     * @param PieceQuantik $p
     */
    public function setPiece(int $rowNum, int $colNum, PieceQuantik $p) : void {
        $this->cases[$rowNum][$colNum] = $p;
    }

    /**
     * Renvois un tableau correspondant la ligne du plateau dont le numéro est
     * passé en paramètre
     * @param int $numRow
     * @return array
     */
    public function getRow(int $numRow) : array {
        return $this->cases[$numRow];
    }

    /**
     * Renvois un tableau correspondant la colonne du plateau dont le numéro est
     * passé en paramètre
     * @param int $numCol
     * @return array
     */
    public function getCol(int $numCol) : array {
        return  array ($this->cases[0][$numCol], $this->cases[1][$numCol],
            $this->cases[2][$numCol], $this->cases[3][$numCol]);
    }

    /**
     * Renvois un tableau correspondant au coin du plateau dont la direction est
     * passée en paramètre (les pièces sont rangées dans l'ordre des lignes puis des colonnes)
     * @param int $dir
     * @return array
     */
    public function getCorner(int $dir) : array {
        switch ($dir) {
            case self::NW :
                return [$this->cases[0][0], $this->cases[0][1],
                    $this->cases[1][0], $this->cases[1][1]];
            case self::NE :
                return [$this->cases[0][2], $this->cases[0][3],
                    $this->cases[1][2], $this->cases[1][3]];
            case self::SW :
                return [$this->cases[2][0], $this->cases[2][1],
                    $this->cases[3][0], $this->cases[3][1]];
            case self::SE :
                return [$this->cases[2][2], $this->cases[2][3],
                    $this->cases[3][2], $this->cases[3][3]];


        }
    }

    /**
     * Renvois la direction de la piece correspondant au numéro de ligne et colonne passé
     * en paramètre.
     * @param int $rowNum
     * @param int $colNum
     * @return int
     */
    public static function getCornerFromCoord(int $rowNum, int $colNum) : int {
        if ($rowNum < 2) {
            if ($colNum < 2)
                return PlateauQuantik::NW;
            else
                return PlateauQuantik::NE;
        }
        else {
            if ($colNum < 2)
                return PlateauQuantik::SW;
            else
                return PlateauQuantik::SE;
        }
    }
}
