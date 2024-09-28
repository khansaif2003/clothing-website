<?php
require_once(LIB_PATH . DS . "config.php");

class Database {
    var $sql_string = '';
    var $error_no = 0;
    var $error_msg = '';
    private $conn;
    public $last_query;

    function __construct() {
        $this->open_connection();
    }

    // Open database connection
    public function open_connection() {
        $this->conn = mysqli_connect(server, user, pass);
        if (!$this->conn) {
            echo "Problem in database connection! Contact administrator!";
            exit();
        } else {
            $db_select = mysqli_select_db($this->conn, database_name);
            if (!$db_select) {
                echo "Problem in selecting database! Contact administrator!";
                exit();
            }
        }
    }

    // Set the query to be executed
    function setQuery($sql = '') {
        $this->sql_string = $sql;
    }

    // Execute the query
    function executeQuery() {
        $result = mysqli_query($this->conn, $this->sql_string);
        $this->confirm_query($result);
        return $result;
    }

    // Confirm if query executed successfully
    private function confirm_query($result) {
        if (!$result) {
            $this->error_no = mysqli_errno($this->conn);
            $this->error_msg = mysqli_error($this->conn);
            return false;
        }
        return $result;
    }

    // Load multiple results into a list
    function loadResultList($key = '') {
        $cur = $this->executeQuery();
        $array = array();
        while ($row = mysqli_fetch_object($cur)) {
            if ($key) {
                $array[$row->$key] = $row;
            } else {
                $array[] = $row;
            }
        }
        mysqli_free_result($cur);
        return $array;
    }

    // Load a single result
    function loadSingleResult() {
        $cur = $this->executeQuery();
        $data = null;
        while ($row = mysqli_fetch_object($cur)) {
            $data = $row;
        }
        mysqli_free_result($cur);
        return $data;
    }

    // Get the fields of a table
    function getFieldsOnOneTable($tbl_name) {
        $this->setQuery("DESC " . $tbl_name);
        $rows = $this->loadResultList();
        $f = array();
        for ($x = 0; $x < count($rows); $x++) {
            $f[] = $rows[$x]->Field;
        }
        return $f;
    }

    // Fetch array from result set
    public function fetch_array($result) {
        return mysqli_fetch_array($result);
    }

    // Get the number of rows in the result set
    public function num_rows($result_set) {
        return mysqli_num_rows($result_set);
    }

    // Get the last inserted ID
    public function insert_id() {
        return mysqli_insert_id($this->conn);
    }

    // Get the number of affected rows
    public function affected_rows() {
        return mysqli_affected_rows($this->conn);
    }

    // Escape values to prevent SQL injection
    public function escape_value($value) {
        return mysqli_real_escape_string($this->conn, $value);
    }

    // Close database connection
    public function close_connection() {
        if (isset($this->conn)) {
            mysqli_close($this->conn);
            unset($this->conn);
        }
    }
}

$mydb = new Database();
?>
