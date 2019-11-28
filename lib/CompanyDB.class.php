<?php
/*
   Handles database access for the Company table. 

 */
class CompanyDB 
{  
    private $pdo = null;
    private static $baseSQL = "SELECT symbol, name, sector,subindustry,address,exchange,website FROM companies ";
    private static $constraint = ' ORDER BY symbol';
    
    public function __construct($connection) {
        $this->pdo = $connection;
    }
    
    public function getAll()
    {
        $sql = self::$baseSQL . self::$constraint;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();        
    }   
    
    public function findById($id)
    {
        $sql = self::$baseSQL . " WHERE symbol=?";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($id));
        return $statement->fetch();        
    }      
    
    

}

?>