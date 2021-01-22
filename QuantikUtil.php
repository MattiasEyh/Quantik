<?php


class QuantikUtil
{
    static function getDivPiecesDisponibles(ArrayPiecesQuantik $pieces) : string {
        $div = "<div id = 'piecesDispo'>\n";
        for($i = 0; $i < $pieces->getTaille(); $i++) {
            $div += "\t<button type='submit' name='active' disabled  value=''>" + $pieces->getPieceQuantik($i) +
                "</button>\n";
        }
        $div += "</div>";
    }

    static function getFormSelectionPiece(ArrayPieceQuantik $pieces) : string {
        /*return "<form action='" + $_SERVER['REQUEST_URI'] + "' method='post'>\n" +
            self::getDivPiecesDisponibles($pieces) + "\n</form>";*/
        $form = "<form action='" + $_SERVER['REQUEST_URI'] + "' method='post'>\n";
        $form += "\t<div id = 'piecesDispo'>\n";
        for($i = 0; $i < $pieces->getTaille(); $i++) {
            $form += "\t\t<button type='submit' name='active' disabled>" + $pieces->getPieceQuantik($i) +
                "</button>\n";
        }
        $form += "\t</div>\n";
        $form += "</form>";
    }

    static function getFormPlateauQuantik(PlateauQuantik $plateau, PieceQuantik $piece): string{
        $form = "<form action='" + $_SERVER['REQUEST_URI'] + "' method='post'>\n";
        $form += "\t<table>\n";
        $action = new ActionQuantik($plateau);
        for($i = 0; i < $plateau::NBROWS; $i++){
            $form += "\t\t<tr>";
            for($j = 0; j < $plateau::NBCOLS; $j++){
                if($action->isValidePose($i,$j,$piece))
                    $form += "<td> <button type='submit' name='position' class ='casePlateauActivee' 
                        value ='" + $i + "," + $j + "'>" + $plateau.getPiece($i, $j) + "</button>\n";
                else
                    $form += "<td> <button type='submit' name='position' class ='casePlateauDesactivee' disabled>" +
                        $plateau.getPiece($i, $j) + "</button>\n";
            }
            $form += "</tr>\n";
        }
        $form += "\t</table>\n";
        $form += "</form>";
    }


}

// Question 7 : Le cube blanc (en supposant que les blancs jouent en premier)
// Question 8 :