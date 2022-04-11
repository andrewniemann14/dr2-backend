<?php
require_once PROJECT_ROOT_PATH . "/Dao/Dao.php";

class ChallengeDao extends Dao {
  // /challenges?id=123456
  public function getChallenge($id) {
    return $this->select("SELECT * FROM challenges WHERE id = ?", ["i", $id]);
  }
  // /challenges
  public function getLastChallenges($limit) {
    return $this->select("SELECT * FROM challenges ORDER BY id DESC LIMIT ?", ["i", $limit]);
  }
}