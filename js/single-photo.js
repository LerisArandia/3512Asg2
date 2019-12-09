/*** 
 * Functionality for Single Photo View Page
 * Referenced Code from Jamie's Assignment 1 and Lab 3 - Chapter 10.
 * 
***/
/********************** Interactive Map ***********************/
/***
 * The Interactive Map
 * Referenced Code from Lab 3 - Chapter 10
***/
var map;
function initMap(latitude, longitude) {
    map = new google.maps.Map(document.querySelector('#spvMapBox'), {
        center: { lat: latitude, lng: longitude},
        zoom: 15
    });
}
/***
 * Map Marker
 * Referenced Code from Lab 3 - Chapter 10
***/
function createMarker(map, latitude, longitude, name) {
    let imageLatLong = { lat: latitude, lng: longitude };
    let marker = new google.maps.Marker({
        position: imageLatLong,
        title: name,
        map: map
    });
}
/********** Fetch URL **********/
let imageid = document.querySelector("#singleImage").getAttribute("alt");
let url = "./database/api-images.php?id=" + imageid;

fetch(url)
    .then(response => response.json())
    .then(data => {
        imageArray = data[0];
        initMap(imageArray.Latitude, imageArray.Longitude);
        createMarker(map, imageArray.Latitude, imageArray.Longitude, imageArray.Title);
    })
    .catch(error => console.log(error));

/**********Changing Tabs**********/
descBox = document.querySelector('#spvDescBox');
detailsBox = document.querySelector('#spvDetailsBox');
mapBox = document.querySelector('#spvMapBox');

//Description tab Event Listener
document.querySelector('#spvDescTab').addEventListener('click', e => {
    if (e.target && e.target.nodeName.toLowerCase() == 'button') {
        //Show description box
        descBox.style.display = 'block';
        //Hide detail & map box
        detailsBox.style.display = 'none';
        mapBox.style.display = 'none';
    }
});
//Detaill tab Event Listner
document.querySelector('#spvDetailsTab').addEventListener('click', e => {
    if (e.target && e.target.nodeName.toLowerCase() == 'button') {
        //Show detail box
        detailsBox.style.display = 'block';
        //Hide description and map
        descBox.style.display = 'none';
        mapBox.style.display = 'none';
    }
});
//Map tab Event Listener
document.querySelector('#spvMapTab').addEventListener('click', e => {
    if (e.target && e.target.nodeName.toLowerCase() == 'button') {
        //Show map box
        mapBox.style.display = 'block';
        //Hide description and detail box
        descBox.style.display = 'none';
        detailsBox.style.display = 'none';
    }
});
/**********Hover Image Display**********/
//Mouse hovered over the photo or hover box, hover box shows
document.querySelector('#spvImg').addEventListener('mouseover', () => {
    document.querySelector('#hoverBox').style.display = 'block';
});
document.querySelector('#hoverBox').addEventListener('mouseover', () => {
    document.querySelector('#hoverBox').style.display = 'block';
});
//Mouseout of photo && hover box, hover box hides
document.querySelector('#spvImg').addEventListener('mouseout', () => {
    document.querySelector('#hoverBox').style.display = 'none';
});
document.querySelector('#hoverBox').addEventListener('mouseout', () => {
    document.querySelector('#hoverBox').style.display = 'none';
});