<?php
require_once PROJECT_ROOT_PATH . "/Dao/Dao.php";



class LeaderboardDao extends Dao {

  // /leaderboard?name=8ourne
  public function getAllPersonals($name) {
    return $this->select("SELECT * FROM challenges INNER JOIN leaderboard ON leaderboard.challenge_id = challenges.id WHERE name = ?", ["s", $name]);
  }

  // /leaderboard?name=8ourne?limit=20
  public function getRecentPersonals($name, $limit) {
    return $this->select("SELECT * FROM challenges INNER JOIN leaderboard ON leaderboard.challenge_id = challenges.id WHERE name = ? ORDER BY id DESC LIMIT ?", ["si", $name, $limit]);
  }
  
  // /leaderboard?name=8ourne?stage=blahblah?limit=10
  public function getFastestPersonalsForStage($name, $stage, $limit) {
    return $this->select("SELECT * FROM challenges INNER JOIN leaderboard ON leaderboard.challenge_id = challenges.id WHERE name = ? AND stage = ? ORDER BY time ASC LIMIT ?", ["ssi", $name, $stage, $limit]);
  }
  
  // /leaderboard?name=8ourne?stage=blahblah?class=eRallyR5Caps
  public function getFastestPersonalForStageAndClass($name, $stage, $class) {
    return $this->select("SELECT * FROM challenges INNER JOIN leaderboard ON leaderboard.challenge_id = challenges.id WHERE name = ? AND stage = ? AND vehicle_class = ? ORDER BY time ASC LIMIT 1", ["sss", $name, $stage, $class]);
  }
  
  // /leaderboard?name=8ourne?stage=blahblah
  public function getFastestPersonalsForStagePerClass($name, $stage) {
    return $this->select("SELECT * FROM challenges INNER JOIN leaderboard ON leaderboard.challenge_id = challenges.id WHERE name = ? AND stage = ? GROUP BY vehicle_class ORDER BY time ASC", ["ss", $name, $stage]);
  }

  // /leaderboard?stage=blahblah
  public function getFastestGlobalsForStage($stage) {
    return $this->select("SELECT * FROM leaderboard INNER JOIN challenges ON leaderboard.challenge_id = challenges.id WHERE challenges.stage = ? GROUP BY challenges.vehicle_class ORDER BY leaderboard.time", ["s", $stage]);
  }

  // /leaderboard?stage=blahblah?class=eR5C?limit=10
  public function getFastestGlobalsForStageAndClass($stage, $class, $limit) {
    return $this->select("SELECT * FROM challenges INNER JOIN leaderboard ON leaderboard.challenge_id = challenges.id WHERE stage = ? AND vehicle_class = ? GROUP BY name ORDER BY time ASC LIMIT ?", ["ssi", $stage, $class, $limit]);
  }

  // /leaderboard?id=123456
  public function getSingleLeaderboard($id) {
    return $this->select("SELECT * FROM leaderboard WHERE challenge_id = ?", ["i", $id]);
    // return $this->select("SELECT * FROM challenges INNER JOIN leaderboard ON leaderboard.challenge_id = challenges.id WHERE challenge_id = ?", ["i", $id]);
  }


}