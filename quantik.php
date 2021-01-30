<?php
/**
 * @author Dominique Fournier
 * @date janvier 2021
 */

require_once("PieceQuantik.php");
require_once("PlateauQuantik.php");
require_once("ActionQuantik.php");
require_once("QuantikException.php");
require_once("QuantikUIGenerator.php");

session_start();


if (isset($_GET['reset'])) { //pratique pour réinitialiser une partie à la main
    unset($_SESSION['etat']);
    unset($_SESSION['lesBlancs']);
    unset($_SESSION['lesNoirs']);
    unset($_SESSION['couleurActive']);
    unset($_SESSION['plateau']);
    unset($_SESSION['message']);
    unset($_SESSION['submited']);
}

if (empty($_SESSION)) { // initialisation des variables de session
    $_SESSION['lesBlancs'] = ArrayPieceQuantik::initPiecesBlanches();
    $_SESSION['lesNoirs'] = ArrayPieceQuantik::initPiecesNoires();
    $_SESSION['plateau'] = new PlateauQuantik();
    $_SESSION['etat'] = 'choixPiece';
    $_SESSION['couleurActive'] = PieceQuantik::WHITE;
    $_SESSION['message'] = "";
    $_SESSION['submited'] = true;
}

$pageHTML = "";

$pageHTML .= QuantikUIGenerator::getDebutHTML();

$aq = new ActionQuantik($_SESSION['plateau']);

// on réalise les actions correspondant à l'action en cours :
try {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'choisirPiece':
                $_SESSION['etat'] = 'posePiece';
                break;
            case 'poserPiece':
                $position = $_POST['position'];
                $piece = PieceQuantik::initVoid();
                $setOpposant = new ArrayPieceQuantik();
                if ($_SESSION['couleurActive'] == PieceQuantik::WHITE) {
                    $piece = $_SESSION['lesBlancs']->getPieceQuantik($position);
                    $_SESSION['lesBlancs']->removePieceQuantik($position);
                    $setOpposant = $_SESSION['lesNoirs'];
                } else {
                    $piece=  $_SESSION['lesNoirs']->getPieceQuantik($position);
                    $_SESSION['lesNoirs']->removePieceQuantik($position);
                    $setOpposant = $_SESSION['lesBlancs'];
                }
                $row = explode(',', $_POST['posPlateau'])[0];
                $col = explode(',', $_POST['posPlateau'])[1];
                $aq = new ActionQuantik($_SESSION['plateau']);
                $aq->posePiece($row, $col, $piece);
                $dir = PlateauQuantik::getCornerFromCoord($row, $col);
                if($aq->isRowWin($row) || $aq->isColWin($col) || $aq->isCornerWin($dir)
                    || $aq->isPlayerInStalemate($setOpposant)){
                    $_SESSION['etat'] = 'victoire';
                } else {
                    $_SESSION['couleurActive'] = $_SESSION['couleurActive'] == PieceQuantik::WHITE ?
                        PieceQuantik::BLACK : PieceQuantik::WHITE;
                    $_SESSION['etat'] = 'choixPiece';
                }
                break;
            case 'annulerChoix':
                $_SESSION['etat'] = 'choixPiece';
                break;
            default:
                throw new QuantikException("Action non valide");
        }
    }
} catch (QuantikException $exception) {
    $_SESSION['etat'] = 'bug';
    $_SESSION['message'] = $exception->__toString();
}


switch($_SESSION['etat']) {
    case 'choixPiece':
        $pageHTML .= QuantikUIGenerator::getPageSelectionPiece(['lesBlancs' => $_SESSION['lesBlancs'],
            'lesNoirs' => $_SESSION['lesNoirs']], $_SESSION['couleurActive'], $_SESSION['plateau']);
        break;
    case 'posePiece':
        $pageHTML .= QuantikUIGenerator::getPagePosePiece(['lesBlancs' => $_SESSION['lesBlancs'],
            'lesNoirs' => $_SESSION['lesNoirs']], $_SESSION['couleurActive'], $_POST['position'], $_SESSION['plateau']);
        break;
    case 'victoire':
        $pageHTML .= QuantikUIGenerator::getPageVictoire(['lesBlancs' => $_SESSION['lesBlancs'],
            'lesNoirs' => $_SESSION['lesNoirs']], $_SESSION['couleurActive'], $_SESSION['plateau']);
        break;
    default: // sans doute etape=bug
        echo QuantikUIGenerator::getPageErreur($_SESSION['message']);
        exit(1);
}

// seul echo nécessaire toute la pageHTML a été générée dans la variable $pageHTML
$pageHTML .= QuantikUIGenerator::getLienRecommencer();
$pageHTML .= QuantikUIGenerator::getFinHTML();
echo $pageHTML;