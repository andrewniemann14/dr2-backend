<?php
// https://code.tutsplus.com/tutorials/how-to-build-a-simple-rest-api-in-php--cms-37000

// http://data.niemann.app/dr2/index.php/challenges?name=8ourne
// URI [0] =   [1] = dr2  [2] = index.php  [3] = challenges/leaderboard
// queryParams [name] = 8ourne


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require __DIR__ . "/inc/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);


// if ((isset($uri[2]) && $uri[2] != 'user') || !isset($uri[3])) {
//   header("HTTP/1.1 404 Not Found");
//   exit();
// }

if ($uri[3] == 'challenges') {
  $controller = new ChallengeController();
} else if ($uri[3] == 'leaderboard') {
  $controller = new LeaderboardController();
}

$methodName = 'control' . ucfirst($uri[3]); // controlLeaderboard()
$controller->{$methodName}();
?>