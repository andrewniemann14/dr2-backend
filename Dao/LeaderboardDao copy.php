<?php
require_once PROJECT_ROOT_PATH . "/Dao/Dao.php";



class LeaderboardDao extends Dao {

  $query = "SELECT * FROM challenges INNER JOIN leaderboard ON leaderboard.challenge_id = challenges.id WHERE ";

  

  // /entries?name=8ourne
  public function getAllPersonals($name) {
    return $this->select("name = ?", ["s", $name]);
  }

  // /entries?name=8ourne?limit=20
  public function getRecentPersonals($name, $limit) {
    return $this->select("name = ? ORDER BY id DESC LIMIT ?", ["si", $name, $limit]);
  }

  // /entries?name=8ourne?stage=blahblah?class=eRallyR5Caps
  public function getFastestPersonalForStageAndClass($name, $stage, $class) {
    return $this->select("name = ? AND stage = ? AND vehicle_class = ? ORDER BY time ASC LIMIT 1", ["sss", $name, $stage, $class]);
  }

  // /entries?name=8ourne?stage=blahblah?limit=10
  public function getFastestPersonalsForStage($name, $stage, $limit) {
    return $this->select("name = ? AND stage = ? ORDER BY time ASC LIMIT ?", ["ssi", $name, $stage, $limit]);
  }


  // /entries?stage=blahblah?class=eR5C?limit=10
  public function getFastestGlobalsForStageAndClass($stage, $class, $limit) {
    return $this->select("stage = ? AND vehicle_class = ? ORDER BY time ASC LIMIT ?", ["ssi", $stage, $class, $limit]);
  }
}