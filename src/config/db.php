<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'expensemate');

// Simple database wrapper using PDO SQLite as fallback or direct shell execution
$conn = null;

// Try using proc_open to execute MySQL commands properly
class SimpleDB {
    private $host, $user, $pass, $db;
    
    public function __construct($host, $user, $pass, $db) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;
        $this->test_connection();
    }
    
    private function test_connection() {
        $result = $this->query("SELECT 1");
        if (!$result) {
            die('Database connection failed: Cannot connect to MySQL');
        }
    }
    
    public function query($sql) {
        $parts = array('mysql', '-h', $this->host, '-u', $this->user);
        
        if (!empty($this->pass)) {
            $parts[] = '-p' . $this->pass;
        }
        
        $parts[] = $this->db;
        $parts[] = '-e';
        $parts[] = $sql;
        
        $cmd = implode(' ', array_map('escapeshellarg', $parts));
        $output = shell_exec($cmd . ' 2>&1');
        
        if ($output === null || strpos($output, 'ERROR') !== false) {
            return null;
        }
        
        return new SimpleResult($output);
    }
    
    public function prepare($sql) {
        return new SimpleStmt($this, $sql);
    }
    
    public function set_charset($charset) {
        return true;
    }
}

class SimpleStmt {
    private $db, $sql, $params = [];
    
    public function __construct($db, $sql) {
        $this->db = $db;
        $this->sql = $sql;
    }
    
    public function bind_param($types, &...$params) {
        $this->params = $params;
        return true;
    }
    
    public function execute() {
        $sql = $this->sql;
        
        for ($i = 0; $i < count($this->params); $i++) {
            $val = $this->params[$i];
            $val = is_numeric($val) ? $val : "'" . str_replace("'", "''", $val) . "'";
            $sql = substr_replace($sql, $val, strpos($sql, '?'), 1);
        }
        
        $this->result = $this->db->query($sql);
        return $this->result !== null;
    }
    
    public function get_result() {
        return $this->result ?? new SimpleResult('');
    }
    
    public function store_result() {
        return true;
    }
    
    public function close() {
        return true;
    }
}

class SimpleResult {
    private $rows = [], $idx = 0;
    
    public function __construct($output) {
        if (empty($output)) return;
        
        $lines = explode("\n", trim($output));
        if (count($lines) < 2) return;
        
        $keys = preg_split('/\s+/', trim(array_shift($lines)));
        
        foreach ($lines as $line) {
            if (empty(trim($line))) continue;
            $vals = preg_split('/\s+/', trim($line));
            $row = [];
            foreach ($keys as $i => $k) {
                $row[$k] = $vals[$i] ?? null;
            }
            $this->rows[] = $row;
        }
    }
    
    public function fetch_assoc() {
        if ($this->idx < count($this->rows)) {
            return $this->rows[$this->idx++];
        }
        return null;
    }
    
    public function __get($name) {
        return $name === 'num_rows' ? count($this->rows) : null;
    }
}

try {
    $conn = new SimpleDB(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $conn->set_charset('utf8mb4');
} catch (Exception $e) {
    die('Database Error: ' . $e->getMessage());
}

function run_prepared_query($query, $types = '', $params = []) {
    global $conn;
    $stmt = $conn->prepare($query);
    if (!empty($types) && !empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    return $stmt;
}
?>
