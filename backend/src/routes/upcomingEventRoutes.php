<?php

require_once __DIR__ . '/../controllers/upcomingEventController.php';

use Controllers\UpcomingEventsController;
use Middleware\VerifyUser;

$router->get('/upcoming-events', [UpcomingEventsController::class, 'getAllUpcomingEvents']);
$router->post('/upcoming-events', [UpcomingEventsController::class, 'createUpcomingEvent'], [VerifyUser::class]);
$router->patch('/upcoming-events', [UpcomingEventsController::class, 'updateUpcomingEvent'], [VerifyUser::class]);
$router->delete('/upcoming-events', [UpcomingEventsController::class, 'deleteUpcomingEvent'], [VerifyUser::class]);
