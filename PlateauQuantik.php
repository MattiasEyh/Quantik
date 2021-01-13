<!DOCTYPE html>

<html>
<head>
    <title>Cours PHP & MySQL</title>
    <meta charset="utf-8">
</head>

<body>

<?php


class PlateauQuantik
{
    const NBROWS = 4;
    const NBCOLS = 4;
    const NW = 0;
    const NE = 2;
    const SW = 3;
    const SE = 4;

    protected array $cases;

    public function __construct(){
        $this->cases = array();

        for ($i=0; $i < self::NBROWS; $i++)
            for ($j=0; $j < self::NBCOLS; $j++)
                $this->cases[i][j] = null;
    }

    public function getPiece(int $rowNum, int $colNum) : PieceQuantik{
        if ( $rowNum <= self::NBROWS AND $colNum <= self::NBCOLS)
            return $this->cases[$rowNum][$colNum];
    }

    public function setPiece(int $rowNum, int $colNum, PieceQuantik p) : void{
        if ( $rowNum <= self::NBROWS AND $colNum <= self::NBCOLS)
            $this->cases[$rowNum][$colNum] = p;
    }
}

$instancePlateau = new PlateauQuantik();

?>

</body>

</html>
