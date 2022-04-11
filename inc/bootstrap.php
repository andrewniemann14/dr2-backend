<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");

require_once PROJECT_ROOT_PATH . "/inc/config.php";
require_once PROJECT_ROOT_PATH . "/Controller/BaseController.php";
require_once PROJECT_ROOT_PATH . "/Controller/ChallengeController.php";
require_once PROJECT_ROOT_PATH . "/Controller/LeaderboardController.php";
require_once PROJECT_ROOT_PATH . "/Controller/PlayerController.php";
require_once PROJECT_ROOT_PATH . "/Dao/ChallengeDao.php";
require_once PROJECT_ROOT_PATH . "/Dao/LeaderboardDao.php";
require_once PROJECT_ROOT_PATH . "/Dao/PlayerDao.php";
?>