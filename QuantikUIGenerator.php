<?php

require_once "PlateauQuantik.php";
require_once "ArrayPieceQuantik.php";

/**
 * Class QuantikUIGenerator
 */
class QuantikUIGenerator
{

    /**
     * @param string $title
     * @return string
     */
    public static function getDebutHTML(string $title = "Quantik"): string
    {
        return "<!doctype html>
<html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <title>$title</title>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"quantik.css\" />
    </head>
    <body>
        <h1 class=\"quantik\">$title</h1>
        <div class='quantik'>\n";
    }

    /**
     * @return string
     */
    public static function getFinHTML(): string
    {
        return "</div></body>\n</html>";
    }

    /**
     * @param string $message
     * @return string
     */
    public static function getPageErreur(string $message): string
    {
        header("HTTP/1.1 400 Bad Request");
        $resultat = self::getDebutHTML("400 Bad Request");
        $resultat .= "<h2>$message</h2>";
        $resultat .= "<p><br /><br /><br /><a href='quantik.php?reset'>Retour à l'accueil...</a></p>";
        $resultat .= self::getFinHTML();
        return $resultat;
    }

    /**
     * @param PieceQuantik $pq
     * @return string
     */
    public static function getButtonClass(PieceQuantik $pq) {
        if ($pq->getForme()==PieceQuantik::VOID)
            return "vide";
        $ch = $pq->__toString();
        return substr($ch,1,2).substr($ch,4,1);
    }

    /**
     * production d'un bloc HTML pour présenter l'état du plateau de jeu,
     * l'attribution de classes en vue d'une utilisation avec les est un bon investissement...
     * @param PlateauQuantik $p
     * @return string
     */
    public static function getDivPlateauQuantik(PlateauQuantik $p): string
    {
        $resultat = "";
        $resultat .= "<table>";
        for($i = 0; $i<$p::NBROWS; $i++){
            $resultat .= "<tr>";
            for($j=0; $j < $p::NBCOLS; $j++){
                $resultat .= "<th><button type='submit' name='active' disabled >" . $p->getPiece($i, $j) .
                    "</button></th>";
            }
            $resultat .= "</tr>";
        }
        $resultat .= "</table>";

        return $resultat;
    }

    /**
     * @param ArrayPieceQuantik $apq
     * @param int $pos permet d'identifier la pièce qui a été sélectionnée par l'utilisateur avant de la poser (si != -1)
     * @return string
     */
    public static function getDivPiecesDisponibles(ArrayPieceQuantik $apq, int $pos = -1): string {
        $resultat ="";

        $resultat .= "<div id = 'piecesDispo'><br>";
        for ($i = 0; $i < $apq->getTaille(); $i++) {
            $resultat .= "<button type='submit' name='position' disabled>" . $apq->getPieceQuantik($i) .
                "</button>";
        }
        $resultat .= "</div>";



        return $resultat;
    }

    /**
     * @param ArrayPieceQuantik $apq
     * @return string
     */
    public static function getFormSelectionPiece(ArrayPieceQuantik $apq): string {
        $resultat = "";
        $resultat .= "<form action='" . $_SERVER['REQUEST_URI'] . "' method='post'>";
        $resultat .= "<input id='action' name='action' type='hidden' value='choisirPiece'/>";
        $resultat  .= "<div id = 'piecesDispo'>";
        for($i = 0; $i < $apq->getTaille(); $i++) {
            $resultat  .= "<button type='submit' name='position' value=" . $i . ">" . $apq->getPieceQuantik($i) .
                "</button>";
        }
        $resultat  .= "</div><br>";
        $resultat  .= "</form>";

        return $resultat;
    }

    /**
     * @param PlateauQuantik $plateau
     * @param PieceQuantik $piece
     * @param int $position position de la pièce qui sera posée en vue de la transmettre via un champ caché du formulaire
     * @return string
     */
    public static function getFormPlateauQuantik(PlateauQuantik $plateau, PieceQuantik $piece, int $position): string {
        $resultat ="";
        $resultat .= "<form method='post' action='" . $_SERVER['REQUEST_URI'] . "'>";
        $resultat .= "<input id='position' name='position' type='hidden' value='" . $position . "'/>";
        $resultat .= "<input id='action' name='action' type='hidden' value='poserPiece'/>";

        $aq = new ActionQuantik($plateau);

        $resultat .= "<table>";
        for($i = 0; $i<$plateau::NBROWS; $i++){
            $resultat .= "<tr>";
            for($j=0; $j < $plateau::NBCOLS; $j++){
                if($aq->isValidePose($i,$j,$piece))
                    $resultat .= "<td> <button type='submit' name='posPlateau' value='" . $i . "," . $j .
                        "' style='background-color: green'>" . $plateau->getPiece($i, $j) . "</button><br/>";
                else
                    $resultat .= "<td> <button type='submit' name='posPlateau' disabled>" .
                        $plateau->getPiece($i, $j) . "</button><br/>";
            }
            $resultat .= "</tr>";
        }
        $resultat .= "</table><br/>";
        $resultat .= "</form>";

        // ajout d'un formulaire pour modifier le choix de la pièce à poser
        $resultat .= self::getFormBoutonAnnuler();

        return $resultat;
    }

    /**
     * @return string
     */
    public static function getFormBoutonAnnuler() : string {
        return
            "<div>
                <form method='post' action='" . $_SERVER['REQUEST_URI'] . "'>
                    <input id='annuler' name='action' type='submit' value='annulerChoix'> Annuler son Choix </input>
                </form>
            </div>";
    }

    /**
     * @param int $couleur
     * @return string
     */
    public static function getDivMessageVictoire(int $couleur) : string {
        /* TODO div annonçant la couleur victorieuse et proposant un lien pour recommencer une nouvelle partie */
        $stringCoul = $couleur == 0 ? "Blancs" : "Noirs";
        $resultat ="";

        $resultat .= "<div><h4>Victoire des" . $stringCoul . "!</h4></div>";
        return $resultat;
    }

    /**
     * @return string
     */
    public static function getLienRecommencer():string {
        /* TODO production d'un lien pour recommencer une partie */
        return "<p><a href='" . $_SERVER['REQUEST_URI'] ."?reset=0' > Recommencer ?</a></p>";
    }

    /**
     * @param array $lesPiecesDispos tableau contenant 2 ArrayPieceQuantik un pour les pièves blanches, un pour les pièces noires
     * @param int $couleurActive
     * @param PlateauQuantik $plateau
     * @return string
     */
    public static function getPageSelectionPiece(array $lesPiecesDispos, int $couleurActive, PlateauQuantik $plateau): string {
        $pageHTML = "";

        $pageHTML .= $couleurActive == PieceQuantik::WHITE ? self::getFormSelectionPiece($lesPiecesDispos['lesBlancs']) :
                                                             self::getDivPiecesDisponibles($lesPiecesDispos['lesBlancs']);
        $pageHTML .= self::getDivPlateauQuantik($plateau);

        $pageHTML .= $couleurActive == PieceQuantik::BLACK ? self::getFormSelectionPiece($lesPiecesDispos['lesNoirs']) :
                                                             self::getDivPiecesDisponibles($lesPiecesDispos['lesNoirs']);
        return $pageHTML;
    }

    /**
     * @param array $lesPiecesDispos tableau contenant 2 ArrayPieceQuantik un pour les pièves blanches, un pour les pièces noires
     * @param int $couleurActive
     * @param int $posSelection position de la pièce sélectionnée dans la couleur active
     * @param PlateauQuantik $plateau
     * @return string
     */
    public static function getPagePosePiece(array $lesPiecesDispos, int $couleurActive, int $posSelection, PlateauQuantik $plateau): string {
        $pageHTML = "";
        $pieceActive = $couleurActive == PieceQuantik::WHITE ? $lesPiecesDispos['lesBlancs']->getPieceQuantik($posSelection) : $lesPiecesDispos['lesNoirs']->getPieceQuantik($posSelection);
        $pageHTML .= "<div><h1>Pièce à poser </h1><p>" . $pieceActive . "</p></div>";
        $pageHTML .= self::getFormBoutonAnnuler();
        $pageHTML .= self::getDivPiecesDisponibles($lesPiecesDispos["lesBlancs"]);
        $pageHTML .= self::getFormPlateauQuantik($plateau, $pieceActive, $posSelection);
        $pageHTML .= self::getDivPiecesDisponibles($lesPiecesDispos["lesNoirs"]);
        return $pageHTML;
    }

    /**
     * @param array $lesPiecesDispos tableau contenant 2 ArrayPieceQuantik un pour les pièves blanches, un pour les pièces noires
     * @param int $couleurActive
     * @param int $posSelection
     * @param PlateauQuantik $plateau
     * @return string
     */
    public static function getPageVictoire(array $lesPiecesDispos, int $couleurActive, PlateauQuantik $plateau): string {
        $pageHTML = "";

        $ar1 = $lesPiecesDispos["lesBlancs"];
        $ar2 = $lesPiecesDispos["lesNoirs"];

        $pageHTML .= "<h3>Pieces blanches</h3></br><div>" . self::getDivPiecesDisponibles($ar1) . "</div><hr>";
        $pageHTML .= "<h3>Pieces noires</h3></br><div>" . self::getDivPiecesDisponibles($ar2) . "</div><hr>";


        $pageHTML .= $plateau.self::getDivPlateauQuantik($plateau);

        $pageHTML .= self::getDivMessageVictoire($couleurActive);

        return $pageHTML;
    }

}