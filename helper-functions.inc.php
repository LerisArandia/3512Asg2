<?php

function getCountrySql(){
    $sql = 'SELECT ISO, ISONumeric, CountryName, Capital, CityCode, Area, Population, Continent, TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages, Neighbours, CountryDescription FROM countries';
    // $sql .= " ORDER BY CountryName";
    return $sql;
}

function getCitySql(){
    $sql = "SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone FROM cities";
    $sql .= " ORDER BY AsciiName";
    return $sql;
}

function getAllCountries($connection){

    try{
        // $connection = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
        $result = runQuery($connection, getCountrySql(), null);
        return $result;
    }
    catch (PDOException $e){
        die( $e->getMessage() );
    }

}

function getAllCities($connection){

    try{
        $connection = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
        $result = runQuery($connection, getCitySql(), null);
        return $result;
    }
    catch (PDOException $e){
        die( $e->getMessage() );
    }

}

function getACountry($connection, $code){

    try{
        // $connection = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
        $sql = getCountrySql() . ' WHERE ISO=?';
        $result = runQuery($connection, $sql, $code);

        return $result;
    }
    catch(PDOException $e){
        die( $e->getMessage() );
    }

}

function getACity($connection, $code){

    try{
        $connection = setConnectionInfo(DBCONNSTRING, DBUSER, DBPASS);
        $sql = getCountrySql() . " WHERE CityCode=" . $code;
        $result = runQuery($connection, $sql, null);

        return $result;
    }
    catch(PDOException $e){
        die( $e->getMessage() );
    }

}


?>