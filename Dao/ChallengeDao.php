<?php
require_once PROJECT_ROOT_PATH . "/Dao/Dao.php";

class ChallengeDao extends Dao {
  public function getChallenges($limit) {
    // first sorts them recent first, then takes the top X.
    return $this->select("SELECT * FROM challenges ORDER BY id DESC LIMIT ?", ["i", $limit]);
  }
}