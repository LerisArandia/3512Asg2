document.addEventListener("DOMContentLoaded", function () {

    function updateStorage(key, arrayName) { localStorage.setItem(key, JSON.stringify(arrayName)); }
    function retrieveStorage(key) { return JSON.parse(localStorage.getItem(key)) || []; }
    function removeStorage(key) { localStorage.removeItem(key); }

    var countriesArray = retrieveStorage('countries');
    var countriesWithImagesArray = retrieveStorage('imageCountries');
    displayCountryArray(countriesArray);

    function displayCountryArray(arrayToBeDisplayed) {
        let results = document.querySelector("#countryListCityPage");
        results.innerHTML = "";

        arrayToBeDisplayed = sortArrayByName(arrayToBeDisplayed);

        arrayToBeDisplayed.forEach(n => {
            let a = document.createElement("a");
            let br = document.createElement("br");
            a.setAttribute("href", `https://localhost/3512Asg2/single-country.php?countryiso=${n.ISO}`);
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

    // ------------ Search for Country --------------- //

    document.querySelector("#searchCountriesCityPage").addEventListener("input", displaySearchResults);
    function displaySearchResults() {

        if (this.value.length >= 2) {
            const matchingCountries = findMatches(this.value, countriesArray);
            matchingCountries.sort();

            let results = document.querySelector("#countryListCityPage");
            results.innerHTML = "";

            matchingCountries.forEach(m => {
                let a = document.createElement("a");
                let br = document.createElement("br");
                a.setAttribute("href", `/3512Asg2/single-country.php?countryiso=${m.ISO}`);
                a.innerHTML = m.CountryName;
                a.append(br);
                results.appendChild(a);
            })
        }
        else {
            document.querySelector("#countryListCityPage").innerHTML = "";
            displayCountryArray(countriesArray);
        }
    }

    function findMatches(searchedCountry, countriesArray) {
        return countriesArray.filter(c => {
            const regex = new RegExp(searchedCountry, 'gi');
            return c.CountryName.match(regex);
        })
    }

    // ------- Search By Continent ------ //

    let option = document.querySelector("select#continentCityPage");
    option.addEventListener("click", function (e) {
        displayByContinent(this.value);
    });

    function displayByContinent(chosenContinent) {
        if (chosenContinent != "") {

            let countryListResults = document.querySelector("#countryListCityPage");
            countryListResults.textContent = "";

            let filteredContinents = findContinents(chosenContinent, countriesArray);
            filteredContinents.sort();

            filteredContinents.forEach(c => {
                let a = document.createElement("a");
                let br = document.createElement("br");
                a.setAttribute("href", `/3512Asg2/single-country.php?countryiso=${c.ISO}`);
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


    // ------- Countries With Images Only ------ //

    document.querySelector("#imageCountryOnlyCityPage").addEventListener("click", function () {
        if (this.checked) {

            let countryListResults = document.querySelector("#countryListCityPage");
            countryListResults.textContent = "";

            displayCountryArray(countriesWithImagesArray);

        }
        else {
            countriesArray = retrieveStorage("countries");
            displayCountryArray(countriesArray);
        }
    })

    // ------ Clear All Filters ------- //

    document.querySelector('#clearCountryCityPage').addEventListener("click", function (e) {
        e.preventDefault();
        let search = document.querySelector("#searchCountriesCityPage");
        search.value = "";

        let selectList = document.querySelector("select#continentCityPage");
        selectList.value = "";

        let clearButton = document.querySelector("#imageCountryOnlyCityPage");
        clearButton.checked = false;

        let countryListResults = document.querySelector("#countryListCityPage");
        countryListResults.textContent = "";

        displayCountryArray(countriesArray);


    })

    /* Set the width of the side navigation to 250px */

    document.querySelector("#close").addEventListener("click", closeNav);

    document.querySelector("p#clickMe").addEventListener("click", openNav);


    function openNav() {
        console.log("help");
        document.getElementById("filtersCountryCityPage").style.width = "15em";
        document.getElementById("main-cityPage").style.marginLeft = "15em";
        document.getElementById("header").style.marginLeft = "15em";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("filtersCountryCityPage").style.width = "0em";
        document.getElementById("main-cityPage").style.marginLeft = "0em";
        document.getElementById("header").style.marginLeft = "0em";
    }




})