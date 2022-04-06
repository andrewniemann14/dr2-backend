<?php
require_once PROJECT_ROOT_PATH . "/Model/DatabaseModel.php";

class ChallengeModel extends DatabaseModel {
  public function getChallenges($limit) {
    // first sorts them recent first, then takes the top X.
    return $this->select("SELECT * FROM challenges ORDER BY id DESC LIMIT ?", ["i", $limit]);
  }
}