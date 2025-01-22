<?php

class MSSQLConnection {
    private $connection = null;
    private $config;

    public function __construct(array $config) {
        $this->config = $config;
    }

    public function connect() {
        try {
            // Build the connection string
            $connectionString = sprintf(
                "odbc:Driver={ODBC Driver 18 for SQL Server};".
                "Server=%s,%s;".
                "Database=%s;".
                "LoginTimeout=30;".
                "ConnectionTimeout=30;".
                "TrustServerCertificate=yes;",
                $this->config['server'],
                $this->config['port'],
                $this->config['database']
            );

            // Create the connection
            $this->connection = new PDO(
                $connectionString,
                $this->config['username'],
                $this->config['password'],
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_TIMEOUT => 30
                )
            );

            return true;
        } catch (PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    public function query($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Query failed: " . $e->getMessage());
        }
    }

    public function fetchAll($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }

    public function fetchOne($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }

    public function close() {
        $this->connection = null;
    }
}

// Example usage:
try {
    // Configuration
    $config = [
        'server' => 'PHMKPWDWH110',
        'port' => '1433',
        'database' => 'C1_DEV',
        'username' => 'c1_maintenance_api_user',
        'password' => 'S418jEru2i'
    ];

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Create connection instance
    $db = new MSSQLConnection($config);
    $db->connect();

    // Example queries
    // Select query with parameters
    $users = $db->fetchAll(
        "SELECT * FROM VW_TransactionType",
        []
    );
    
    // Insert query with named parameters
    // $db->query(
    //     "INSERT INTO users (name, email) VALUES (:name, :email)",
    //     [
    //         ':name' => 'John Doe',
    //         ':email' => 'john@example.com'
    //     ]
    // );

    // Close connection
    $db->close();

    echo "<pre>";
    echo json_encode($users, JSON_PRETTY_PRINT);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}