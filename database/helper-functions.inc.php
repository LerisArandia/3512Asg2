<?php

require_once 'config.inc.php';
require_once 'db-functions.inc.php'; 

function getCountrySql(){
    $sql = 'SELECT ISO, ISONumeric, CountryName, Capital, countries.CityCode, Area, countries.Population, Continent, TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages, Neighbours, CountryDescription FROM countries';
    return $sql;
}

function getCitySql(){
    $sql = "SELECT cities.CityCode, AsciiName, CountryCodeISO, cities.Latitude, cities.Longitude, cities.Population, Elevation, TimeZone FROM cities";
    return $sql;
}

function getImageSql(){
    $sql = "SELECT Title, Description, i.Latitude, i.Longitude, AsciiName, CountryName , ContinentCode, Path, Exif, ActualCreator, CreatorURL, SourceURL, Colors 
            FROM imagedetails as i 
            INNER JOIN cities as city ON i.CityCode = city.CityCode
            INNER JOIN countries as c ON i.CountryCodeISO = c.ISO";
    return $sql;
}

function getAllCountries($connection){

    try{
        $result = runQuery($connection, getCountrySql(), null);
        return $result;
    }
    catch (PDOException $e){
        die( $e->getMessage() );
    }

}

function getAllCities($connection){

    try{
        $result = runQuery($connection, getCitySql(), null);
        return $result;
    }
    catch (PDOException $e){
        die( $e->getMessage() );
    }

}

function getACountry($connection, $iso){

    try{
        $sql = getCountrySql() . ' WHERE ISO=?';
        $result = runQuery($connection, $sql, $iso);

        return $result;
    }
    catch(PDOException $e){
        die( $e->getMessage() );
    }

}

function getACity($connection, $cityCode){

    try{
        $sql = getCitySql() . ' WHERE cities.CityCode=?';
        
        $result = runQuery($connection, $sql, $cityCode);

        return $result;
    }
    catch(PDOException $e){
        die( $e->getMessage() );
    }

}


function getAllCitiesInCountry($connection, $iso){

    try{
        $sql = getCitySql() . ' WHERE CountryCodeISO=?';
        $result = runQuery($connection, $sql, $iso);
        
        return $result;
    }
    catch(PDOException $e){
        die( $e->getMessage());
    }

}


?>