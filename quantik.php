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

$aq = new ActionQuantik($_SESSION['plateau']);

// on réalise les actions correspondant à l'action en cours :
    try {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'choisirPiece':
                    /* TODO */
                    break;
                case 'poserPiece':
                    /* TODO : action pouvant conduire à 2 états selon le résultat : posePiece ou victoire */
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
echo $pageHTML;
