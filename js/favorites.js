/*** 
 * Adding and Removing Favorites and presenting a feedback asynchronously using JS
 * Used on add/remove favorites in Single Photo View. 
 * 
 * Followed this tutorial: 
 * https://github.com/dcode-youtube/js-ajax-form-submission
 * https://youtu.be/zvt8ff3d63Q
 * 
***/

//Grabs inital form input information
let form = {
    id: document.querySelector('#photoID'),
    btn: document.querySelector('#btn'),
    submit: document.querySelector('.favorite')
}

//Grabs favorites form
const fav = document.querySelector('#fav');

//Event Listener for favorites form 
fav.addEventListener('click', e => {
    e.preventDefault();

    //Grabs form input information
    form = {
        id: document.querySelector('#photoID'),
        btn: document.querySelector('#btn'),
        submit: document.querySelector('.favorite')
    }

    //Start of AJAX form submission
    const request = new XMLHttpRequest();

    //When request is loaded
    request.onload = () => {
        console.log(request.responseText);
        let responseObject = null;
        //Parses text from response
        try {
            responseObject = JSON.parse(request.responseText);
        }catch (e){ //Error handling for parsing
            console.error('Could not parse JSON!');
        }
        //If parse is successful
        if (responseObject){
        handleResponseRemove(responseObject);
        }
    };
    let requestData = '';

    //If form is removing favorites, send to remove favorite php
    if(form.btn.value == 'remove'){
        requestData = `remove=${form.submit.value}&id=${form.id.value}&single=true`;
        request.open('POST', './includes/removeFavorite.php');
    //If form is adding favorites, send to add favorites php
    }else{
        requestData = `favorite=${form.submit.value}&id=${form.id.value}&single=true`;
        request.open('POST', './includes/addFavorite.php');
    }
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.send(requestData);
    
    //function runs after response is processed. 
    function handleResponseRemove (responseObject){
        console.log(responseObject);
        let ok = responseObject.ok;
        let msg = responseObject.message;
        //If adding a favorite
        if(ok == 'favorite'){
            //Change to remove favorites button
            fav.innerHTML = `<input type="submit" id="remove" class="favorite" value="Remove from Favorites" name="remove"/>
                             <input type='hidden' id='btn' name='btn' value='remove'/>
                             <input type='hidden' id='photoID' name='id' value='${form.id.value}'>`;
            //Outputs feedback message
            document.querySelector('#changeFav').innerHTML = msg;
            document.querySelector('#changeFav').style.display = 'grid';
            if(document.querySelector('#changeFav').classList.contains('removeFav')){
                document.querySelector('#changeFav').classList.toggle('removeFav')
            }
            document.querySelector('#changeFav').classList.toggle('addFav');
        }else if(ok == 'remove'){ //If removing a favorite
            //Change to add favorites button
            fav.innerHTML = `<input type="submit" id="addFavorite" class="favorite" value="Add to Favorites" name="favorite"/>
                             <input type='hidden' id='btn' name='btn' value='favorite'/>
                             <input type='hidden' id='photoID' name='id' value='${form.id.value}'>`;
             //Outputs feedback message
            document.querySelector('#changeFav').innerHTML = msg;
            document.querySelector('#changeFav').style.display = 'grid';
            if(document.querySelector('#changeFav').classList.contains('addFav')){
                document.querySelector('#changeFav').classList.toggle('addFav')
            }
            document.querySelector('#changeFav').classList.add('removeFav');
        }else{ //If user not logged in, moves user to login page. 
            console.log('yes');
            location.href = msg;
        }
    }
});