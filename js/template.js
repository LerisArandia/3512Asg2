const hamburgerMenu = document.querySelector('#burger');
console.log("hamburger menu");
hamburgerMenu.addEventListener('click', e => {
    if (e.target && e.target.nodeName.toLowerCase() == 'div') {
        const nav = document.querySelector('#navigation');
        console.log('click');
        if (nav.style.display === 'block') {
            nav.style.display = 'none';
        } else {
            nav.style.display = 'block';
        }
    }
});

document.addEventListener("DOMContentLoaded", function () {
    var countriesArray = [];
    var citiesArray = [];

    function updateStorage(key, arrayName) { localStorage.setItem(key, JSON.stringify(arrayName)); }
    function retrieveStorage(key) { return JSON.parse(localStorage.getItem(key)) || []; }
    function removeStorage(key) { localStorage.removeItem(key); }

    // --------------------------------checking local storage for countries and city arrays-------------------------------- //

    var countriesArray = retrieveStorage("countries");

    if (!retrieveStorage("countries") || retrieveStorage("countries").length === 0) { fillCountriesArray() }
    else {
        displayCountryArray(countriesArray);
    }

    if (!retrieveStorage("cities") || retrieveStorage("cities").length === 0) { fillCitiesArray() }
    else {
        // displayArray(countriesArray);
    }



    function fillCountriesArray() {
        var countriesArray = [];

        // gets all countries
        let allCountriesUrl = "http://localhost/3512Asg2/api-countries.php";

        fetch(allCountriesUrl)
            .then(response => response.json())
            .then(data => {
                data.forEach(d => countriesArray.push(d));
                updateStorage("countries", countriesArray);
                displayCountryArray(countriesArray);
            })
            .catch(error => console.log(error));
    }

    function fillCitiesArray() {
        var citiesArray = [];

        // gets all cities
        let allCitiesUrl = "http://localhost/3512Asg2/api-cities.php";

        fetch(allCitiesUrl)
            .then(response => response.json())
            .then(data => {
                data.forEach(d => citiesArray.push(d));
                updateStorage("cities", citiesArray);
                displayArray(citiesArray);
            })
            .catch(error => console.log(error));
    }

    function displayCountryArray(arrayToBeDisplayed) {
        let results = document.querySelector("#countryList");
        results.innerHTML = "";

        arrayToBeDisplayed = sortArrayByName(arrayToBeDisplayed);

        arrayToBeDisplayed.forEach(n => {
            let a = document.createElement("a");
            let br = document.createElement("br");
            a.setAttribute("href", `http://localhost/3512Asg2/single-country.php?countryiso=${n.ISO}`);
            a.innerHTML = n.CountryName;
            a.append(br);
            results.appendChild(a);
        }
        )
    }

    function sortArrayByName(array) {
        array.sort((a, b) => {
            var x = a.CountryName.toLowerCase();
            var y = b.CountryName.toLowerCase();
            if (x < y) { return -1; }
            if (x > y) { return 1; }
            return 0;
        })
        return array;
    }





})