<?php

require_once "PlateauQuantik.php";
require_once "ArrayPieceQuantik.php";

/**
 * Class QuantikUIGenerator
 */
class QuantikUIGenerator
{

    private static function functionGetRefNoRest() : string {
        return explode('?',$_SERVER['REQUEST_URI'])[0];
    }


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
        $resultat = "<div id='plateau'> ";
        $resultat .= "<table id='tableauPlateau' cellspacing=0>";
        for($i = 0; $i<$p::NBROWS; $i++){
            $resultat .= "<tr class='rowPlateau'>";
            for($j=0; $j < $p::NBCOLS; $j++){
                $resultat .= "<td class='dataPlateau' style=\"z-index: ".(1 + $i + PlateauQuantik::NBCOLS - $j)."\"><input class='inputPlateau' type='submit' name='active' disabled ></input>" .
                    self::getImageFromPiece($p->getPiece($i, $j)) . "</td>";
            }
            $resultat .= "</tr>";
        }
        $resultat .= "</table><div class='botEdges'>
          <div class='botEdge'></div>
          <div class='botEdge'></div>
          <div class='botEdge'></div>
          <div class='botEdge'></div>
      </div>
      <div class='sideEdges'>
          <div class='sideEdge'></div>
          <div class='sideEdge'></div>
          <div class='sideEdge'></div>
          <div class='sideEdge'></div>
      </div></div>";
        return $resultat;
    }

    /**
     * @param ArrayPieceQuantik $apq
     * @param int $pos permet d'identifier la pièce qui a été sélectionnée par l'utilisateur avant de la poser (si != -1)
     * @return string
     */
    public static function getDivPiecesDisponibles(ArrayPieceQuantik $apq, int $pos = -1): string {
        $resultat = "<div class='piecesDispo'>";
        for ($i = 0; $i < $apq->getTaille(); $i++) {
            $resultat .= "<div class='pieceField'><input class='selectPiece' type='submit' name='position' disabled></input>" . self::getImageFromPiece($apq->getPieceQuantik($i)) .
                "</div>";
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
        $resultat .= ("<form class='piecesDispo' action='" . self::functionGetRefNoRest() . "' method='post'>");
        $resultat .= "<input class='action' name='action' type='hidden' value='choisirPiece'/>";
        for($i = 0; $i < $apq->getTaille(); $i++) {
            $resultat  .= "<div class='pieceField'> <input class='selectPiece' type='submit' name='position' value=" . $i . "></input>" . self::getImageFromPiece($apq->getPieceQuantik($i)) ."</div>";
        }
        $resultat  .= "<br>";
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
        $resultat = "<form id='plateau' method='post' action='" . self::functionGetRefNoRest() . "'>";
        $resultat .= "<input id='position' name='position' type='hidden' value='" . $position . "'/>";
        $resultat .= "<input id='action' name='action' type='hidden' value='poserPiece'/>";

        $aq = new ActionQuantik($plateau);

        $resultat .= "<table id='tableauPlateau' cellspacing=0>";
        for($i = 0; $i<$plateau::NBROWS; $i++){
            $resultat .= "<tr class='rowPlateau'>";
            for($j=0; $j < $plateau::NBCOLS; $j++){
                if($aq->isValidePose($i,$j,$piece))
                    $resultat .= "<td class='dataPlateau'> <input class='inputPlateau' type='submit' name='posPlateau' value='" . $i . "," . $j .
                        "' style='background-color: dodgerblue'></input>" . self::getImageFromPiece($plateau->getPiece($i, $j)) . "</td>";
                else
                    $resultat .= "<td class='dataPlateau'> <input class='inputPlateau' type='submit' name='posPlateau' disabled></input>" .
                        self::getImageFromPiece($plateau->getPiece($i, $j)) . "<td/>";
            }
            $resultat .= "</tr>";
        }
        $resultat .= "</table><div class='botEdges'>
          <div class='botEdge'></div>
          <div class='botEdge'></div>
          <div class='botEdge'></div>
          <div class='botEdge'></div>
      </div>
      <div class='sideEdges'>
          <div class='sideEdge'></div>
          <div class='sideEdge'></div>
          <div class='sideEdge'></div>
          <div class='sideEdge'></div>
      </div>";
        $resultat .= "</form>";

        return $resultat;
    }

    /**
     * @return string
     */
    public static function getFormBoutonAnnuler() : string {
        return
            "<div>
                <form method='post' action='" .self::functionGetRefNoRest() . "'>
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
        $stringCoul = $couleur == PieceQuantik::WHITE ? "Blancs" : "Noirs";
        $resultat ="";

        $resultat .= "<div><h4>Victoire des " . $stringCoul . "!</h4></div>";
        return $resultat;
    }

    /**
     * @return string
     */
    public static function getLienRecommencer():string {
        /* TODO production d'un lien pour recommencer une partie */
        return "<div id='reset' ><a id='resetLink' href='" . $_SERVER['REQUEST_URI'] ."?reset=0' > Recommencer ?</a></div>";
    }

    /**
     * @param array $lesPiecesDispos tableau contenant 2 ArrayPieceQuantik un pour les pièves blanches, un pour les pièces noires
     * @param int $couleurActive
     * @param PlateauQuantik $plateau
     * @return string
     */
    public static function getPageSelectionPiece(array $lesPiecesDispos, int $couleurActive, PlateauQuantik $plateau): string {
        $pageHTML = "";
        $pageHTML .= "<div id='lesBlancs'></div>";
        $pageHTML .= $couleurActive == PieceQuantik::WHITE ? self::getFormSelectionPiece($lesPiecesDispos['lesBlancs']) :
            self::getDivPiecesDisponibles($lesPiecesDispos['lesBlancs']);
        $pageHTML .= self::getDivPlateauQuantik($plateau);
        $pageHTML .= "<div id='lesNoirs'></div>";
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
        $pageHTML .= "<div></div>";
        $pageHTML .= self::getFormBoutonAnnuler();
        $pageHTML .= "<div id='lesBlancs'></div>";
        $pageHTML .= self::getDivPiecesDisponibles($lesPiecesDispos["lesBlancs"]);
        $pageHTML .= self::getFormPlateauQuantik($plateau, $pieceActive, $posSelection);
        $pageHTML .= "<div id='lesNoirs'></div>";
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

        $pageHTML .= "<div id='lesBlancs'></div>";
        $pageHTML .= self::getDivPiecesDisponibles($ar1) ;
        $pageHTML .= "<div id='lesNoirs'></div>";
        $pageHTML .= self::getDivPiecesDisponibles($ar2) ;


        $pageHTML .= $plateau.self::getDivPlateauQuantik($plateau);

        $pageHTML .= self::getDivMessageVictoire($couleurActive);

        return $pageHTML;
    }

    private static function getImageFromPiece(PieceQuantik $piece){
        $src = "images/";// ou chemin
        switch ($piece->__toString()){
            case "(    )":
                $src .= "void.png";
                break;
            case "(Cu:B)":
                $src .= "cube_blanc.png";
                break;
            case "(Co:B)";
                $src .= "cone_blanc.png";
                break;
            case "(Cy:B)";
                $src .= "cylindre_blanc.png";
                break;
            case "(Sp:B)";
                $src .= "sphere_blanc.png";
                break;
            case "(Cu:N)":
                $src .= "cube_noir.png";
                break;
            case "(Co:N)";
                $src .= "cone_noir.png";
                break;
            case "(Cy:N)";
                $src .= "cylindre_noir.png";
                break;
            case "(Sp:N)";
                $src .= "sphere_noir.png";
                break;
            default : break;
        }
        return "<img class='piece' src='" . $src . "' alt='" . $src . "'>";
    }

}