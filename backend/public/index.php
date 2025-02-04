<?php
// CORS Headers
header("Access-Control-Allow-Origin: " . ($_SERVER['HTTP_ORIGIN'] ?? '*'));
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

// Handle preflight (OPTIONS request)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(204);
    exit;
}

// Load environment variables
require_once __DIR__ . "/../src/core/LoadEnv.php";
(new \Core\LoadEnv())->load();

// Load JWT Handler
require_once __DIR__ . "/../src/core/JwtHandler.php";

use Core\Jwt;

Jwt::init();


// Load dependencies
require_once "../src/core/Router.php";
require_once "../src/core/Response.php";
require_once "../src/core/Database.php";
require_once "../src/middleware/FileUpload.php";
require_once "../src/middleware/VerifyUser.php";

use Core\Router;

$router = new Router();

require_once "../src/routes/api.php"; // Load routes

$router->resolve();
