<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

$corePath = dirname(__DIR__) . '/project-core';

require_once $corePath . '/config/Database.php';

require_once $corePath . '/src/Controllers/AuthController.php';
require_once $corePath . '/src/Controllers/CandidateController.php';
require_once $corePath . '/src/Controllers/ApplicationController.php';

$db = Database::getConnection();

$route = $_GET['route'] ?? 'home';

switch ($route) {

    case 'home':
        (new CandidateController($db))->index();
        break;

    case 'login':
        (new AuthController($db))->login();
        break;

    case 'register':
        (new AuthController($db))->register();
        break;

    case 'logout':
        (new AuthController($db))->logout();
        break;

    case 'profile':
        (new AuthController($db))->profile();
        break;

    case 'apply':
        (new ApplicationController($db))->apply();
        break;

    case 'delete_application':
        (new ApplicationController($db))->delete();
        break;

    // 🔥 НОВОЕ
    case 'admin_applications':
        (new ApplicationController($db))->admin();
        break;

    case 'update_application_status':
        (new ApplicationController($db))->updateStatus();
        break;

    case 'admin':
        (new CandidateController($db))->admin();
        break;

    case 'candidate_form':
        (new CandidateController($db))->form();
        break;

    case 'save_candidate':
        (new CandidateController($db))->save();
        break;

    case 'delete_candidate':
        (new CandidateController($db))->delete();
        break;

    default:
        echo "404";
}