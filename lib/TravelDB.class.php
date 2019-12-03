<?php
/*
   Handles database access for the Country table. 

 */
class CountryDB 
{  
    private $pdo = null;
    private static $baseSQL = 'SELECT ISO, ISONumeric, CountryName, Capital, CityCode, Area, Population, Continent, TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages, Neighbours, CountryDescription FROM countries';
    private static $constraint = ' ORDER BY ISO';
    
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
        $sql = self::$baseSQL . " WHERE ISO=?";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($id));
        return $statement->fetch();        
    }      
    
    

}

?>