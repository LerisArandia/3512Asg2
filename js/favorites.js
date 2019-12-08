/*** 
 * Followed this tutorial: 
 * 
 * https://youtu.be/zvt8ff3d63Q
 * https://github.com/dcode-youtube/js-ajax-form-submission/blob/master/index.html 
 * 
***/
const form = {
    id: document.querySelector('#photoID'),
    btn: document.querySelector('#btn'),
    submit: document.querySelector('.favorite')
}

// const removeform = {
//     id: document.querySelector('#photoID'),
//     btn: document.querySelector('#removebtn'),
//     submit: document.querySelector('#remove')
// }

const fav = document.querySelector('#fav');
fav.addEventListener('click', e => {
    e.preventDefault();
    document.querySelector('#changeFavorite').innerHTML = "Added to Favorites!";
    console.log(form);

});

//         // const request = new XMLHttpRequest();

//         // request.onload = () => {
//         //     console.log(request.responseText);
//         //     let responseObject = null;

//         //     try {
//         //         responseObject = JSON.parse(request.responseText);
//         //     }catch (e){
//         //         console.error('Could not parse JSON!');
//         //     }

//         //     if (responseObject){
//         //         handleResponseRemove(responseObject);
//         //     }
//         // };

//         // const requestData = `remove=${removeform.submit.value}&id=${removeform.id.value}`;
//         // console.log(requestData);

//         // request.open('POST', './includes/removeFavorite.php');
//         // request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
//         // request.send(requestData);
//     });

//     // function handleResponseRemove (responseObject){
//     //     console.log(responseObject);
//     //     //removeFav.parentNode.removeChild(removeFav);

//     // }
// }