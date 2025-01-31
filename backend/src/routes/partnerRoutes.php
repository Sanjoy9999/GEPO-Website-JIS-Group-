<?php

require_once __DIR__ . '/../controllers/PartnerController.php';

use Controllers\PartnerController;
use Middleware\VerifyUser;

$router->post("/partners", [PartnerController::class, "createPartner"], VerifyUser::class);
$router->get("/partners", [PartnerController::class, "getAllPartners"], VerifyUser::class);
$router->get("/partners/countries", [PartnerController::class, "getAllCountries"]);
$router->delete("/partners", [PartnerController::class, "deletePartner"], VerifyUser::class);
