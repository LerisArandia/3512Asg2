<?php
/***
 * INCLUDE FOR 'IMAGES YOU MAY LIKE' ALGORITHM
 */
    require_once ('database/helper-functions.inc.php');

    // photoArray has to be an array of IDS not ISO
    // retrieves certain number of images from bottom of image table
    function retrieveLastNumberResults($photoArray, $number){
        $sql = "SELECT ImageID, Path FROM imagedetails ORDER BY ImageID DESC LIMIT " . $number;
        $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        $result = runQuery($pdo, $sql, null);

        foreach($result as $images){
            $photoArray[] = $images;
        }
        $pdo=null;
        generateImage($photoArray);
    }

    // finds what countries are in a users favorites list
    function findSameCountry($favArray){
        $sameCountry = array();
        $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        $sql = "SELECT CountryCodeISO FROM imagedetails WHERE ImageID=? ";
        foreach ($favArray as $f){
            $result = runQuery($pdo, $sql, $f);
            foreach($result as $country){
                foreach($country as $c){
                    if(!in_array($c, $sameCountry)){
                        $sameCountry[] = $c;
                    }
                }
            }

        }
        $pdo=null;

        // an array that contains the countries ISO that are in favorites array
        return $sameCountry;
    }

    function generateImage($array){

        // so different images appear when user visits page
        shuffle($array);
        for($i = 0; $i < 12; $i++){ // limits to 12 images
            echo "<div>";
            echo "<a href='single-photo.php?id={$array[$i]['ImageID']}'><img src='images/square150/{$array[$i]['Path']}'></a>";
            echo "</div>";
        }   
        
    }

    // passing in an array of ISO
    // gets images that are from countries that are in user's favorites list
    function getImagesFromCountry($sameCountry){
        $pdo = setConnectionInfo(DBCONNECTION, DBUSER, DBPASS);
        $imageArray = array();
        foreach($sameCountry as $country){
            $sql = allImageSql() . " WHERE CountryCodeISO=?";
            $result = runQuery($pdo, $sql, $country);

            foreach($result as $r){
                $imageArray[] = $r;
            }
        }

        if (count($imageArray) < 12){ // fills up rest of array to make up 12
            $remaining = 12 - count($imageArray);
            retrieveLastNumberResults($imageArray, $remaining);
        }
        else{
            generateImage($imageArray);
        }
        $pdo=null;   
    }













?>