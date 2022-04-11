<?php
require_once PROJECT_ROOT_PATH . "/Dao/Dao.php";

class PlayerDao extends Dao {
  // /player?name=8ourne
  public function getPlayer($name) {
    return $this->select("SELECT * FROM racers WHERE name = ?", ["s", $name]);
  }

  // /player?limit=10
  public function getPlayersTopPoints($limit) {
    return $this->select("SELECT * FROM racers ORDER BY points DESC LIMIT ?", ["i", $limit]);
  }
}