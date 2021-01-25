<?php

include_once "ArrayPieceQuantik.php";
include_once "PlateauQuantik.php";

class QuantikUtil
{
    static function getDebutHTML() : string {
        $str = "";

        $str .= "<html lang ='en'> <head> <meta charset='UTF-8'> <title>Solitaire</title></head><body>";

        return $str;
    }

    static function getFinHTML() : string {
        $str = "";

        $str .= "</html></body>";

        return $str;
    }

    static function getDivPiecesDisponibles(ArrayPieceQuantik $pieces) : string {
        $div = "<div id = 'piecesDispo'><br>";
        for($i = 0; $i < $pieces->getTaille(); $i++) {
            $div .= "<button type='submit' name='active' disabled  value=''>" . $pieces->getPieceQuantik($i) .
                "</button>";
        }
        $div .= "</div>";

        return $div;
    }

    static function getFormSelectionPiece(ArrayPieceQuantik $pieces) : string {
        $form = "<form action='" . $_SERVER['REQUEST_URI'] . "' method='post'>";
        $form .= "<div id = 'piecesDispo'>";
        for($i = 0; $i < $pieces->getTaille(); $i++) {
            $form .= "<button type='submit' name='active' value=" . $i . " disabled>" . $pieces->getPieceQuantik($i) .
                "</button><br>";
        }
        $form .= "</div><br>";
        $form .= "</form>";

        return $form;
    }

    static function getDivPlateauQuantik(PlateauQuantik $plateau) : string {
        $form = "<table>";
        for($i = 0; $i<$plateau::NBROWS; $i++){
            $form .= "<tr>";
            for($j=0; $j < $plateau::NBCOLS; $j++){
                $form .= "<th><button type='submit' name='active' disabled  value=''>" . $plateau->getPiece($i, $j) .
                    "</button></th>";
            }
            $form .= "</tr>";
        }
        $form .= "</table>";

        return $form;
    }

    static function getFormPlateauQuantik(PlateauQuantik $plateau, PieceQuantik $piece): string{
       /* $form ="<style>.casePlateauActivee{background-color: green;} .casePlateauDesactivee{background-color: black;}</style>";

        $form .= "<form action='" . $_SERVER['REQUEST_URI'] . "' method='post'>";
        $form .= "<table>";
        $action = new ActionQuantik($plateau);
        for($i = 0; $i < $plateau::NBROWS; $i++){
            $form .= "<tr>";
            for($j = 0; $j < $plateau::NBCOLS; $j++){
                if($action->isValidePose($i,$j,$piece))
                    $form .= "<td> <button type='submit' name='position' class ='casePlateauActivee' 
                        value ='" . $i . "," . $j . "'>" . $plateau->getPiece($i, $j) . "</button><br/>";
                else
                    $form .= "<td> <button type='submit' name='position' class ='casePlateauDesactivee' disabled>" .
                        $plateau->getPiece($i, $j) . "</button><br/>";
            }
            $form .= "</tr><br/>";
        }
        $form .= "</table><br/>";
        $form .= "</form>";

        return $form;*/

        $form = "<form action='" . $_SERVER['REQUEST_URI'] . "' method='post'>";
        $form .= "<table>";
        for($i = 0; $i<$plateau::NBROWS; $i++){
            $form .= "<tr>";
            for($j=0; $j < $plateau::NBCOLS; $j++){
                $form .= "<th><button type='submit' name='active' disabled  value='" . $i . "," . $j . "'>" . $plateau->getPiece($i, $j) .
                    "</button></th>";
            }
            $form .= "</tr>";
        }
        $form .= "</table><br/>";
        $form .= "</form>";

        return $form;
    }

}

// Question 7 : Le cube blanc (en supposant que les blancs jouent en premier)
// Question 8 :