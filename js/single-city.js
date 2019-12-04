document.addEventListener("DOMContentLoaded", function () {



    function updateStorage(key, arrayName) { localStorage.setItem(key, JSON.stringify(arrayName)); }
    function retrieveStorage(key) { return JSON.parse(localStorage.getItem(key)) || []; }
    function removeStorage(key) { localStorage.removeItem(key); }

    // -------------- CHECK LOCAL STORAGE FOR COUNTRY ARRAY ------------- // 

    var countriesArray = retrieveStorage('countries');












})