/** 
 * This js is connected to the single-country php page
 * Referenced Leris' Assignment 1 javascript page
 * 
 * Stores and retrieves countries, countries with images, and cities in local storage
 * 
*/
document.addEventListener("DOMContentLoaded", function () {
    var countriesArray = [];

    // --------------------------------- LOCAL STORAGE FUNCTIONS ------------------------------------- //
    function updateStorage(key, arrayName) { localStorage.setItem(key, JSON.stringify(arrayName)); }
    function retrieveStorage(key) { return JSON.parse(localStorage.getItem(key)) || []; }
    function removeStorage(key) { localStorage.removeItem(key); }

    // ----------------------------------------------------------------------------------------------- //

    var countriesArray = retrieveStorage("countries");

    // If it doesn't exist in local storage, retrieve and display countries
    // Otherwise, display countries
    if (!retrieveStorage("countries") || retrieveStorage("countries").length === 0) { fillCountriesArray() }
    else {
        displayCountryArray(countriesArray);
    }

    // fetch country information and set to local storage
    function fillCountriesArray() {
        var countriesArray = [];

        // gets all countries
        let allCountriesUrl = "./database/api-countries.php";

        fetch(allCountriesUrl)
            .then(response => response.json())
            .then(data => {
                data.forEach(d => countriesArray.push(d));
                updateStorage("countries", countriesArray);
                displayCountryArray(countriesArray);
            })
            .catch(error => console.log(error));
    }

    // displays any country array passed to it
    function displayCountryArray(arrayToBeDisplayed) {
        let results = document.querySelector("#countryList");
        results.innerHTML = "";

        arrayToBeDisplayed = sortArrayByName(arrayToBeDisplayed);

        arrayToBeDisplayed.forEach(n => {
            let a = document.createElement("a");
            let br = document.createElement("br");
            a.setAttribute("href", `/single-country.php?countryiso=${n.ISO}`);
            a.innerHTML = n.CountryName;
            a.append(br);
            results.appendChild(a);
        }
        )
    }

    // sorts country by name rather than country ISO
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

    // ------------ Search Event Listener for Country --------------- //
    document.querySelector("#searchCountries").addEventListener("input", displaySearchResults);
    function displaySearchResults() {

        if (this.value.length >= 1) {
            const matchingCountries = findMatches(this.value, countriesArray);
            matchingCountries.sort();

            let results = document.querySelector("#countryList");
            results.innerHTML = "";

            matchingCountries.forEach(m => {
                let a = document.createElement("a");
                let br = document.createElement("br");
                a.setAttribute("href", `/single-country.php?countryiso=${m.ISO}`);
                a.innerHTML = m.CountryName;
                a.append(br);
                results.appendChild(a);
            })
        }
        else {
            document.querySelector("#countryList").innerHTML = "";
            displayCountryArray(countriesArray);
        }
    }

    function findMatches(searchedCountry, countriesArray) {
        return countriesArray.filter(c => {
            const regex = new RegExp(searchedCountry, 'gi');
            return c.CountryName.match(regex);
        })
    }

    // ------------------------------ EVENT HANDLER FOR CONTINENT DROPDOWN ------------------------------------ //

    let option = document.querySelector("select#continent");
    option.addEventListener("click", function (e) {
        displayByContinent(this.value);
    });

    function displayByContinent(chosenContinent) {
        if (chosenContinent != "") {

            let countryListResults = document.querySelector("#countryList");
            countryListResults.textContent = "";

            let filteredContinents = findContinents(chosenContinent, countriesArray);
            filteredContinents.sort();

            filteredContinents.forEach(c => {
                let a = document.createElement("a");
                let br = document.createElement("br");
                a.setAttribute("href", `/single-country.php?countryiso=${c.ISO}`);
                a.innerHTML = c.CountryName;
                a.append(br);
                countryListResults.appendChild(a);
            })
        }
        else {
            displayCountryArray(countriesArray);
        }
    }

    function findContinents(clickedContinent, countriesArray) {
        return countriesArray.filter(c => {
            const regex = new RegExp(clickedContinent, 'gi');
            return c.Continent.match(regex);
        })
    }

    // -------------------- Fetchs countries with images and stores in local storage ----------------------------- //
    var imageCountriesArray = [];
    document.querySelector("#imageCountryOnly").addEventListener("click", function () {
        if (this.checked) {

            let countryListResults = document.querySelector("#countryList");
            countryListResults.textContent = "";

            let countriesWithImage = "./database/api-countries.php?images=all";

            fetch(countriesWithImage)
                .then(response => response.json())
                .then(data => {
                    imageCountriesArray = [];
                    data.forEach(d => imageCountriesArray.push(d));

                    updateStorage("imageCountries", imageCountriesArray);
                    displayCountryArray(imageCountriesArray);
                })
                .catch(error => console.log(error));
        }
        else {
            countriesArray = retrieveStorage("countries");
            displayCountryArray(countriesArray);
        }
    })

    // ------ Clear All Filters Event Listener ------- //
    document.querySelector('#clearCountry').addEventListener("click", function (e) {
        e.preventDefault();
        let search = document.querySelector("#searchCountries");
        search.value = "";

        let selectList = document.querySelector("select#continent");
        selectList.value = "";

        let clearButton = document.querySelector("#imageCountryOnly");
        clearButton.checked = false;

        let countryListResults = document.querySelector("#countryList");
        countryListResults.textContent = "";

        displayCountryArray(countriesArray);
    })

    // --------- Filter Sidebar ---------- //
    // Was referenced from W3 School 
    // https://www.w3schools.com/howto/howto_js_sidenav.asp

    document.querySelector("#close").addEventListener("click", closeNav);
    document.querySelector("p#clickMe").addEventListener("click", openNav);
    function openNav() {
        document.getElementById("filters").style.width = "15em";
        document.getElementById("main-countryPage").style.marginLeft = "15em";
        document.getElementById("header").style.marginLeft = "15em";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("filters").style.width = "0em";
        document.getElementById("main-countryPage").style.marginLeft = "0em";
        document.getElementById("header").style.marginLeft = "0em";
    }

})