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

//specify country code iso
function citySql(){
    $sql = "SELECT cities.CityCode, AsciiName, cities.CountryCodeISO, cities.Latitude, cities.Longitude, cities.Population, Elevation, TimeZone FROM cities";
    return $sql;
}

function getImageSql(){
    $sql = "SELECT ImageID, Title, Description, i.Latitude, i.Longitude, AsciiName, CountryName , ContinentCode, i.CountryCodeISO, i.CityCode, Path, Exif, ActualCreator, CreatorURL, SourceURL, Colors 
            FROM imagedetails as i 
            INNER JOIN cities as city ON i.CityCode = city.CityCode
            INNER JOIN countries as c ON i.CountryCodeISO = c.ISO";
    return $sql;
}

function getLanguageSql(){
    $sql = "SELECT languages.id, name, languages.iso from languages";
    return $sql;
}

function allImageSql(){
    $sql = "SELECT ImageID, CityCode, CountryCodeISO, Path FROM imagedetails";
    return $sql;
}

function getCountriesWithImagesSql(){
    $sql =  getCountrySql() . " INNER JOIN imagedetails ON countries.ISO = imagedetails.CountryCodeISO GROUP BY countries.ISO";
    // echo $sql;
    return $sql;
}

function getCitiesWithImagesSql(){
    $sql = citySql() . " INNER JOIN imagedetails ON cities.CityCode = imagedetails.CityCode GROUP BY cities.CityCode ORDER BY AsciiName";
    // echo $sql;
    return $sql;
}

function getContinentSql(){
    $sql = "SELECT ContinentCode, ContinentName, GeoNameId from continents";
    return $sql;
}

function getUserInfoSql(){
    $sql = "SELECT UserID, UserName, Password, Salt FROM userslogin";
    return $sql;
}

function getUserInfo($connection, $username){
    try{
        $sql = getUserInfoSql() . " WHERE UserName = '" . $username ."'";
        $result = $connection->query($sql);
        $userInfo = $result->fetch();
        
        return $userInfo;
    }
    catch(PDOException $e){
        die( $e->getMessage());
    }
}

function getContinents($connection){
    try{
        $result = runQuery($connection, getContinentSql(), null);
        return $result;
    }
    catch (PDOException $e){
        die( $e->getMessage() );
    }
}

function getCountriesWithImages($connection){
    try{
        $result = runQuery($connection, getCountriesWithImagesSql(), null);
        return $result;
    }
    catch (PDOException $e){
        die( $e->getMessage() );
    }
}

function getCitiesWithImages($connection){
    try{
        $result = runQuery($connection, getCitiesWithImagesSql(), null);
        return $result;
    }
    catch (PDOException $e){
        die( $e->getMessage() );
    }
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

function getALanguage($connection, $iso){
    
    try{
        $sql = getLanguageSql() . " WHERE iso='". $iso."'";
        $result = $connection->query($sql);
        $language = $result->fetch();
        
        return $language['name'];
    }
    catch(PDOException $e){
        die( $e->getMessage());
    }

}

function findLanguages($pdo, $languages){
    $array = explode(",", $languages);
    $string = "";

    foreach($array as $a){
        $lang = substr($a, 0, 2);
        $langName = getALanguage($pdo, $lang);
        $string .= $langName . ", ";
    }

    return substr($string, 0, -2);
}

function findNeighboringCountries($pdo, $neighbours){
    $array = explode(",", $neighbours);
    $string = "";

    foreach( $array as $a){
        $sql = getCountrySql() . " WHERE ISO='" . $a ."'";
        $result = $pdo->query($sql);
        $country = $result->fetch();

        $string .= " {$country['CountryName']},";
    }

    return substr($string, 0, -1); // removes last comma
}

function getAllImages($connection){

    try{
        $result = runQuery($connection, getImageSql(), null);
        return $result;
    }
    catch (PDOException $e){
        die( $e->getMessage() );
    }

}
function getSingleImage($pdo, $id){
    try{
        $sql = getImageSql() . " WHERE ImageID='" . $id . "'";
        $result = runQuery($pdo, $sql, $id);

        return $result;
    }
    catch(PDOException $e){
        die($e->getMessage());
    }
}

function getCityImages($pdo, $cityID){
    try{
        $sql = getImageSql() . " WHERE i.CityCode='" . $cityID . "'";
        $result = runQuery($pdo, $sql, $cityID);

        return $result;
    }
    catch(PDOException $e){
        die($e->getMessage());
    }
}

function getCountryImages($pdo, $countryID){
    try{
        $sql = getImageSql() . " WHERE i.CountryCodeISO='" . $countryID . "'";
        $result = runQuery($pdo, $sql, $countryID);

        return $result;
    }
    catch(PDOException $e){
        die($e->getMessage());
    }
}

<<<<<<< HEAD

// USERS -----

function getAllUsersSql(){
    $sql = "SELECT UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email, Privacy FROM users";
    return $sql;
}

function singleUserSql($email){
    $sql = getAllUsersSql() . "WHERE Email='" . $email ."'";
    return $sql;
}


/// connect
function getAllUsers($connection){
    try{
        $result = runQuery($connection, getAllUsersSql(), null);
        return $result;
    }
    catch (PDOException $e){
        die( $e->getMessage() );
    }
}

// function getUser($connection){
    
// }
=======
?>
>>>>>>> ralph
