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

// TODO: add a 'leaderboardjoin' option
// TODO: move to a build-a-query format instead of fixed functions

if (isset($uri[3])) {
  if ($uri[3] == 'challenges') {
    $controller = new ChallengeController();
  } else if ($uri[3] == 'leaderboard') {
    $controller = new LeaderboardController();
  } else if ($uri[3] == 'players') {
    $controller = new PlayerController();
  }
  
  $methodName = 'control' . ucfirst($uri[3]); // controlLeaderboard()
  $controller->{$methodName}();
} else {
  echo '<b>Possible queries:</b><br/>/challenges?limit=2<br/>/leaderboard?id=123456<br/>/leaderboard?name=8ourne<br/>/leaderboard?name=8ourne?limit=100<br/>/leaderboard?name=8ourne?stage=blahblah?class=eRallyR5Caps<br/>/leaderboard?name=8ourne?stage=blahblah?limit=10<br/>/leaderboard?stage=blahblah?class=eRallyR5Caps?limit=10<br/>/players<br/>/players?limit=10<br/>/players?name=8ourne';
}

?>