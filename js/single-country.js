document.addEventListener("DOMContentLoaded", function () {


    // --------- checking whether it's country or city details

    let region = document.querySelector(".details").getAttribute('id');
    if (region == "countryDetails") {
        console.log("country details");
    }
    else if (region == "cityDetails") {
        console.log("city details");
    }





})