<?php
require_once PROJECT_ROOT_PATH . "/Dao/Dao.php";

class PlayerDao extends Dao {
  // /players?name=8ourne
  public function getPlayer($name) {
    return $this->select("SELECT * FROM players WHERE name = ?", ["s", $name]);
  }

  // /players
  public function getPlayersAll() {
    return $this->select("SELECT name, nationality FROM players ORDER BY name ASC", []);
  }

  // /players?limit=10
  public function getPlayersTopPoints($limit) {
    return $this->select("SELECT * FROM players ORDER BY points DESC LIMIT ?", ["i", $limit]);
  }
}