document.addEventListener("DOMContentLoaded", function () {
    var countriesArray = [];

    function updateStorage(key, arrayName) { localStorage.setItem(key, JSON.stringify(arrayName)); }
    function retrieveStorage(key) { return JSON.parse(localStorage.getItem(key)) || []; }
    function removeStorage(key) { localStorage.removeItem(key); }

    // -------------------------------- checking local storage for countries and city arrays -------------------------------- //

    var countriesArray = retrieveStorage("countries");

    if (!retrieveStorage("countries") || retrieveStorage("countries").length === 0) { fillCountriesArray() }
    else {
        displayCountryArray(countriesArray);
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

    function displayCountryArray(arrayToBeDisplayed) {
        let results = document.querySelector("#countryList");
        results.innerHTML = "";

        arrayToBeDisplayed.sort((a, b) => {
            var x = a.CountryName.toLowerCase();
            var y = b.CountryName.toLowerCase();
            if (x < y) { return -1; }
            if (x > y) { return 1; }
            return 0;
        })

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




})