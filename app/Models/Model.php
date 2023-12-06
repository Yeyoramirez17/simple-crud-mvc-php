<?php
namespace App\Models;

use mysqli;

class Model
{
    protected $db_host = DB_HOST;
    protected $db_user = DB_USER;
    protected $db_pass = DB_PASS;
    protected $db_name = DB_NAME;
    protected $connection;
    protected $query;
    protected $sql; 
    protected $data = []; 
    protected $params = null;
    protected $orderBy = "";
    protected $table;

    public function __construct()
    {
        $this->connection();
    }
    public function connection()
    {
        $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if ($this->connection->connect_error)
        {
            die('Connection error: ' . $this->connection->connect_error);
        }
    }
    public function query(string $sql, array $data = [], $types = null ) : self
    {
        if ( $data ) {

            if ($types === null) {
                // $params = str_repeat('s', count( $data ));
                $types = self::getTypes($data);
            }

            $stmt = $this->connection->prepare( $sql );
            $stmt->bind_param( $types, ...$data );
            $stmt->execute();

            $this->query = $stmt->get_result();
        } else {
            $this->query = $this->connection->query($sql);
        }

        return $this;
    }
    public function orderBy( string $column, string $order = 'ASC' ) 
    {
        if(empty($this->orderBy)) {
            $this->orderBy = " ORDER BY {$column} {$order}";
        } else {
            $this->orderBy .= ", {$column} {$order}";
        }
        return $this;
        
    }
    public function first()
    {
        if ( empty($this->query) ) {
            
            if(empty($this->sql)) {
                $this->sql = "SELECT * FROM {$this->table}";
            }
            $this->sql .= $this->orderBy;

            $this->query($this->sql, $this->data, $this->params);
        }
        return $this->query->fetch_assoc();
    }
    public function get()
    {
        if ( empty($this->query) ) {
            if(empty($this->sql)) {
                $this->sql = "SELECT * FROM {$this->table}";
            }

            $this->sql .= $this->orderBy;
            $this->query($this->sql, $this->data, $this->params);
        }

        return $this->query->fetch_all(MYSQLI_ASSOC);
    }
    public function paginate( int $cant = 10 )
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        if( $this->sql ) {
            $sql = $this->sql . ($this->orderBy ?? '') . " LIMIT " . ($page -1) * $cant . ",{$cant}";
            $data = $this->query($sql, $this->data, $this->params)->get();
        } else {
            $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} " . ($this->orderBy ?? '') . " LIMIT ". ($page - 1) * $cant .",{$cant}";
            $data = $this->query( $sql )->get();
        }

        $total = $this->query("SELECT FOUND_ROWS() as total")->first()['total'];

        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');

        if(strpos($uri, '?')) {
            $uri = substr( $uri, 0, strpos($uri, '?'));
        }

        $last_page = ceil($total / $cant);

        return [
            'data' => $data,
            'next_page_url' => ( $page < $last_page ) ? "/{$uri}?page=".$page+1 : null,
            'prev_page_url' => ( $page > 1 ) ? "/{$uri}?page=".$page-1 : null,
            'current_page' => $page,
            'last_page' => $last_page,
            'total' => $total,
            'from' => ( $page - 1 ) * $cant + 1,
            'to' => ( $page - 1 ) * $cant + count( $data ),
        ];
    }
    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql)->get();
    }
    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->query($sql, [$id], 'i')->first();
    }
    public function where($column, $operator, $value = null) : self
    {
        if ($value == null) {
            $value = $operator;
            $operator = '=';
        }

        if(empty( $this->sql )) {
            $this->sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} WHERE {$column} {$operator} ?";
            $this->data[] = $value;
        } else {
            $this->sql .= " AND {$column} {$operator} ?";
            $this->data[] = $value;
        }

        return $this;
    }
    public function create( array $data )
    {
        $columns = array_keys($data);
        $columns = implode(', ', $columns);

        $values = array_values($data);

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES (". str_repeat('?, ', count($values) - 1) ."?)";

        $this->query($sql, $values);

        $insert_id = $this->connection->insert_id;

        return $this->find($insert_id);
    }
    public function update( int $id, array $data = [])
    {
        $fields = [];

        foreach($data as $key => $value)
        {
            $fields[] = "{$key} = ? ";
        }

        $fields = implode(', ', $fields);
        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = ?; ";

        $values = array_values($data);
        $values[] = $id;

        $this->query($sql, $values);
        return $this->find($id);
    }

    public function delete( mixed $id) : void
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?; ";
        $this->query($sql, [$id], 'i');
    }
    public static function getTypes( array $params ) : string 
    {
        $types = '';
        
        foreach( $params as $param ) {
            if(is_string($param)) $types .= 's'; 
            if(is_int($param)) $types .= 'i'; 
            if(is_double($param)) $types .= 'd'; 
            if(is_bool($param)) $types .= 'b'; 
        }

        return $types;
    }
}