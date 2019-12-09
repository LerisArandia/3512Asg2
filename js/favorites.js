/*** 
 * Followed this tutorial: 
 * 
 * https://github.com/dcode-youtube/js-ajax-form-submission
 * https://youtu.be/zvt8ff3d63Q
 * 
***/
let form = {
    id: document.querySelector('#photoID'),
    btn: document.querySelector('#btn'),
    submit: document.querySelector('.favorite')
}

const fav = document.querySelector('#fav');
fav.addEventListener('click', e => {
    e.preventDefault();

    form = {
        id: document.querySelector('#photoID'),
        btn: document.querySelector('#btn'),
        submit: document.querySelector('.favorite')
    }

    //console.log("the form:" + form.btn.value);
    //console.log("the id:" + form.id.value);

    const request = new XMLHttpRequest();

    request.onload = () => {
        console.log(request.responseText);
        let responseObject = null;
        try {
            responseObject = JSON.parse(request.responseText);
        }catch (e){
            console.error('Could not parse JSON!');
        }
            
        if (responseObject){
        handleResponseRemove(responseObject);
        }
    };

    let requestData = '';

    if(form.btn.value == 'remove'){
        requestData = `remove=${form.submit.value}&id=${form.id.value}&single=true`;
        request.open('POST', './includes/removeFavorite.php');

    }else{
        requestData = `favorite=${form.submit.value}&id=${form.id.value}&single=true`;
        request.open('POST', './includes/addFavorite.php');
    }

    //console.log(requestData);

    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.send(requestData);
        
    function handleResponseRemove (responseObject){
        console.log(responseObject);
        let ok = responseObject.ok;
        let msg = responseObject.message;
        //console.log(ok);
        //console.log(msg);
        if(ok == 'favorite'){
            fav.innerHTML = `<input type="submit" id="remove" class="favorite" value="Remove from Favorites" name="remove"/>
                             <input type='hidden' id='btn' name='btn' value='remove'/>
                             <input type='hidden' id='photoID' name='id' value='${form.id.value}'>`;
            document.querySelector('#changeFav').innerHTML = msg;
            document.querySelector('#changeFav').style.display = 'grid';
            if(document.querySelector('#changeFav').classList.contains('removeFav')){
                document.querySelector('#changeFav').classList.toggle('removeFav')
            }
            document.querySelector('#changeFav').classList.toggle('addFav');
        }else if(ok == 'remove'){
            fav.innerHTML = `<input type="submit" id="addFavorite" class="favorite" value="Add to Favorites" name="favorite"/>
                             <input type='hidden' id='btn' name='btn' value='favorite'/>
                             <input type='hidden' id='photoID' name='id' value='${form.id.value}'>`;
            document.querySelector('#changeFav').innerHTML = msg;
            document.querySelector('#changeFav').style.display = 'grid';
            if(document.querySelector('#changeFav').classList.contains('addFav')){
                document.querySelector('#changeFav').classList.toggle('addFav')
            }
            document.querySelector('#changeFav').classList.add('removeFav');
        }else{
            console.log('yes');
            location.href = msg;
        }
    }
});