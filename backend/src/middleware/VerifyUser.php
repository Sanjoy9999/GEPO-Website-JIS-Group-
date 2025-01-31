<?php

namespace Middleware;

use PDO;
use Core\Response;
use Core\Database;
use Core\Jwt;

class VerifyUser
{
    public static function handle($data)
    {
        if (isset($_COOKIE['accessToken'])) {
            $accessToken = filter_var($_COOKIE['accessToken'], FILTER_UNSAFE_RAW);
            $decodedToken = Jwt::verifyToken($accessToken);

            if (!$decodedToken) {
                return Response::error(401, 'Unauthorized', ['access token expire', 'You are not logged in', 'Unauthorize access', 'please login']);
            }

            $userId = $decodedToken['id'];
            error_log("userId: " . print_r($userId, true));
            $pdo = Database::connect();
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute([':id' => $userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($user) {
                unset($user['password']);
                $data['user'] = $user;
            } else {
                return Response::error(401, 'Unauthorized', ['You are not logged in', 'Unauthorize access', 'please login']);
            }

            return $data;
        } else {
            return Response::error(401, 'Unauthorized', ['You are not logged in', 'Unauthorize access', 'please login']);
        }

        exit;
    }
}
