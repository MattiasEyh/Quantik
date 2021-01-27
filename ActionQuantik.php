<?php

class ActionQuantik
{
    /**
     * $plateau : PlateauQuantik associé
     * @access protected
     * @var PlateauQuantik
     */
    protected PlateauQuantik $plateau;

    /**
     * Constructeur
     * @access public
     * @param $plateau PlateauQuantik associé
     */
    public function __construct(PlateauQuantik $plateau) {
        $this->plateau = $plateau;
    }

    /**
     * méthode getPlateau
     * renvoie le plateau associé
     * @access public
     * @return PlateauQuantik
     */
    public function getPlateau() : PlateauQuantik {
        return $this->plateau;
    }

    /**
     * méthode isRowWin
     * indique si la ligne dont le numéro est passé en paramètre est gagnante,
     * c'est à dire contient une pièce de chaque forme (hormis PieceQuantik::VOID)
     * @param int $numRow numéro de la ligne à vérifier
     * @access public
     * @return true si la ligne est gagnante, false sinon
     */
    public function isRowWin(int $numRow) : bool {
        $row = $this->plateau->getRow($numRow);
        return self::comboWin($row);
    }

    /**
     * méthode isColWin
     * indique si la colonne dont le numéro est passé en paramètre est gagnante,
     * c'est à dire contient une pièce de chaque forme (hormis PieceQuantik::VOID)
     * @param int $numCol numéro de la colonne à vérifier
     * @access public
     * @return true si la colonne est gagnante, false sinon
     */
    public function isColWin(int $numCol) : bool {
        $Col = $this->plateau->getCol($numCol);
        return self::comboWin($Col);
    }

    /**
     * méthode isCornerWin
     * indique si le coin dont la direction est passé en paramètre est gagnant,
     * c'est à dire contient une pièce de chaque forme (hormis PieceQuantik::VOID)
     * @param int $dir numéro du coin à vérifier
     * @access public
     * @return true si le coin est gagnant, false sinon
     */
    public function isCornerWin(int $dir) : bool {
        $corner = $this->plateau->getCorner($dir);
        return self::comboWin($corner);
    }

    /**
     * méthode isValidePose
     * indique si la pose décrite par les paramètres est légale,
     * c'est à dire que la case est innocupée, et qu'aucune pièce de la même forme
     * que $piece n'est présente dans le coin, la ligne et la colonne correspondante
     * @param PieceQuantik $piece pièce du jeu à poser
     * @param int $rowNum numéro de la ligne où serait posée $piece
     * @param int $colNum numéro de la colonne où serait posée $piece
     * @access public
     * @return true si la pose est légale, false sinon
     */
    public function isValidePose(int $rowNum, int $colNum, PieceQuantik $piece) : bool {
        // La pièce n'est pas vide
        if($piece->getForme() == PieceQuantik::VOID)
            return false;
        // La case est innocupée
        if($this->plateau->getPiece($rowNum, $colNum)->getForme() != PieceQuantik::VOID)
            return false;
        // La ligne ne contient pas de piece de même forme
        $row = $this->plateau->getRow($rowNum);
        if(!self::isPieceValide($row, $piece) )
            return false;
        // La colonne ne contient pas de piece de même forme
        $col = $this->plateau->getCol($colNum);
        if(!self::isPieceValide($col, $piece))
            return false;
        // Le coin ne contient pas de piece de même forme
        $dir = $this->plateau->getCornerFromCoord($rowNum, $colNum);
        $corner = $this->plateau->getCorner($dir);
        if(!self::isPieceValide($corner, $piece))
            return false;
        return true;
    }

    /**
     * méthode posePiece
     * Pose $piece sur $this->plateau à l'emplacement décrit par
     * les paramètres, si la pose est illégale ne fait rien.
     * @param PieceQuantik $piece pièce du jeu à poser
     * @param int $rowNum numéro de la ligne où serait posée $piece
     * @param int $colNum numéro de la colonne où serait posée $piece
     * @access public
     */
    public function posePiece(int $rowNum, int $colNum, PieceQuantik $piece) {
        if($this->isValidePose($rowNum, $colNum, $piece))
            $this->plateau->setPiece($rowNum, $colNum, $piece);
    }

    /**
     * toString
     * représantation du plateau associé
     * @access public
     * @return string;
     */
    public function __toString() : string {
        return $this->plateau;
    }

    /**
     * méthode ComboWin
     * Indique si la "région" d'un plateau passée en paramètre correspond à une
     * combinaison gagnate, c'est à dire contient une piece de chaque forme
     * (hormis PieceQuantik::VOID)
     * A. E. : $pieces représente une "région" d'une partie légale,
     * c'est à dire qu'une forme (hormis PieceQuantik::VOID) n'y apparait qu'au
     * plus une seule fois
     * @param array $pieces tableau représentant la "région" du plateau à vérifier
     * @access private
     * @static
     * @return true si la combinaison est gagnate, false sinon
     */
    private static function ComboWin(array $pieces) : bool {
        $sum = 0;
        $formes = array(0,0,0,0);
        // D'après les règles, on peux assimiler la condition de victoire à
        // Effectuer la pose d'une pièce remplissant totalement une "zone"
        // Sans que cette zone ne contienne de formes en double
        for($i = 0; $i < PlateauQuantik::NBROWS; $i++){
            // Une des cases n'est pas remplie
            if($pieces[$i]->getForme() == PieceQuantik::VOID)
                return false;
            // Si une piece est en double
            if(1 <= $formes[$pieces[$i]->getForme() - 1]++)
                return false;
        }
        return true;
    }

    /**
     * méthode isPieceValide
     * Indique si la pièce passée en paramètre peu être jouée dans la "région"
     * du plateau passée en paramètre.
     * A. E. : $pieces représente une "région" d'une partie légale,
     * c'est à dire qu'une forme (hormis PieceQuantik::VOID) n'y apparait qu'au
     * plus une seule fois
     * @param array $pieces tableau représentant la "région" du plateau à vérifier
     * @param PieceQuantik $p pièce à placer
     * @access private
     * @static
     * @return true si la pièce peut être jouée, false sinon
     */
    private  static function isPieceValide(array $pieces, PieceQuantik $p) : bool {
        for($i = 0; $i < PlateauQuantik::NBROWS; $i++)
            // Si les cases de $pieces sont toutes occupées, d'après les règles
            // une des cases contient déjà une pièce de la forme $p->getForme()
            if($pieces[$i]->getForme() == $p->getForme() && $pieces[$i]->getCouleur() != $p->getCouleur())
                return false;
        return true;
    }
}