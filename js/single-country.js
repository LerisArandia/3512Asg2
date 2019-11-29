document.addEventListener("DOMContentLoaded", function () {
    var countriesArray = [];

    function updateStorage(key, arrayName) { localStorage.setItem(key, JSON.stringify(arrayName)); }
    function retrieveStorage(key) { return JSON.parse(localStorage.getItem(key)) || []; }
    function removeStorage(key) { localStorage.removeItem(key); }

    // -------------------------------- checking local storage for countries and city arrays -------------------------------- //

    var countriesArray = retrieveStorage("countries");
    if (!retrieveStorage("countries") || retrieveStorage("countries").length === 0) { fillCountriesArray() }

    function fillCountriesArray() {
        var countriesArray = [];

        // gets all countries
        let allCountriesUrl = "http://localhost/3512Asg2/api-countries.php";

        fetch(allCountriesUrl)
            .then(response => response.json())
            .then(data => {
                data.forEach(d => countriesArray.push(d));
                updateStorage("countries", countriesArray);
                display();
            })
            .catch(error => console.log(error));
    }

    function display() {
        countriesArray = retrieveStorage("countries"); // has to be "reassigned" to get array properly
        console.log(countriesArray);
    }


})