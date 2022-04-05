<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class Leaderboard extends Database {
  public function getLeaderboard($challenge_id) {
    return $this->select("SELECT * FROM leaderboard WHERE challenge_id=?", ["i", $challenge_id]);
  }
}