<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class Challenge extends Database {
  public function getChallenges($id, $limit) {
    // first sorts them recent first, then takes the top X.
    return $this->select("SELECT * FROM challenges ORDER BY id DESC LIMIT ? WHERE id = ?", ["ii", $limit, $id]);
  }
}