<?php
define('SERVER', $_SERVER['SERVER_NAME']);

if (SERVER != 'localhost' AND SERVER != '127.0.0.1' ) {
   
define('HOST', 'herokuapp.com');
define('USER_NAME', 'optimist_api');
define('PASSWORD', 'optimistic_api');
define('DB_NAME', 'optimist_api');

}else{
   
define('HOST', 'localhost');
define('USER_NAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'api');

}


// class DB start
class Database
{
    private $connection;

    // Constructor
    public function __construct()
    {
        $this->open_db_connection();
    }

    // Creating connection with db
    public function open_db_connection()
    {
        $this->connection = mysqli_connect(HOST, USER_NAME, PASSWORD, DB_NAME);

        if (mysqli_connect_error()) {
            die('Connection Error: '.mysqli_connect_error());
        }
    }

    // Running SQL query on db
    public function query($sql)
    {
        $result = $this->connection->query($sql);

        if (!$result) {
            die('Query fails : '.$sql);
        }

        return $result;
    }

    // Getting list of all rows
    public function fetch_array($result)
    {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultarray[] = $row;
            }
            return $resultarray;
        }
    }

    // Getting only 1 row
    public function fetch_row($result)
    {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }

    // Checking if string is in proper format
    public function escape_value($value)
    {
        $value = $this->connection->real_escape_string($value);
        return $value;
    }

    // Closing connection
    public function close_connection()
    {
        $this->connection->close();
    }
} // Class ends

$database = new Database();
