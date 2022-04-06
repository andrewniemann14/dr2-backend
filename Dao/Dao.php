<?php
// TODO: convert mysqli to PDO

class Dao {
  protected $conn = null;

  // constructor opens the database connection
  public function __construct() {
    try {
      $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

      if (mysqli_connect_errno()) {
        throw new Exception("Could not connect to database");
      }
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
  }

  // simple function executes any SELECT query and returns the resultset
  public function select($query = "", $params = []) {
    try {
      $stmt = $this->executeStatement($query, $params);
      $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
      $stmt->close();

      return $result;
    } catch (Exception $e) {
      throw New Exception($e->getMessage());
    }
    return false;
  }

  private function executeStatement($query = "", $params = []) { // params: ["ssi", $name, $stage, $limit]
    try {
      $stmt = $this->conn->prepare($query);
      if ($stmt === false) {
        throw New Exception("Unable to do prepared statement: " . $query);
      }
      if ($params) {
        $stmt->bind_param(array_slice($params, 0, 1)[0], ...array_slice($params, 1));
      }
      $stmt->execute();
      return $stmt;
    } catch (Exception $e) {
      throw New Exception($e->getMessage());
    }
  }
}