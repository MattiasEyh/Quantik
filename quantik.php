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
}

if (empty($_SESSION)) { // initialisation des variables de session
    $_SESSION['lesBlancs'] = ArrayPieceQuantik::initPiecesBlanches();
    $_SESSION['lesNoirs'] = ArrayPieceQuantik::initPiecesNoires();
    $_SESSION['plateau'] = new PlateauQuantik();
    $_SESSION['etat'] = 'choixPiece';
    $_SESSION['couleurActive'] = PieceQuantik::WHITE;
    $_SESSION['message'] = "";
}

$pageHTML = "";

$pageHTML .= QuantikUIGenerator::getDebutHTML();

$aq = new ActionQuantik($_SESSION['plateau']);

// on réalise les actions correspondant à l'action en cours :
    try {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'choisirPiece':
                    /* TODO */
                    $_SESSION['etat'] = 'posePiece';
                    break;
                case 'poserPiece':
                    /* TODO : action pouvant conduire à 2 états selon le résultat : posePiece ou victoire */
                    $position = $_POST['position'];
                    if ($_SESSION['couleurActive'] == PieceQuantik::WHITE) {
                        $piece = $_SESSION['lesBlancs']->getPieceQuantik($position);
                        $_SESSION['lesBlancs']->removePieceQuantik($position);
                    } else {
                        $piece=  $_SESSION['lesNoirs']->getPieceQuantik($position);
                        $_SESSION['lesNoirs']->removePieceQuantik($position);
                    }

                    $row = explode(',', $_POST['posPlateau'])[0];
                    $col = explode(',', $_POST['posPlateau'])[1];

                    break;
                case 'annulerChoix':
                    /* TODO */
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
        /* TODO */
        break;
    case 'posePiece':
        /* TODO */
        break;
    case 'victoire':
        /* TODO */
        break;
    default: // sans doute etape=bug
        echo QuantikUIGenerator::getPageErreur($_SESSION['message']);
        exit(1);
}
// seul echo nécessaire toute la pageHTML a été générée dans la variable $pageHTML
$pageHTML .= QuantikUIGenerator::getFinHTML();
echo $pageHTML;
