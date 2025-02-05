<?php

use Core\Response;

$router->get("/", function (){
    return Response::success(200, "Everything is fine");
});
