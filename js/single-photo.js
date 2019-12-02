/****Changing Tabs****/
descBox = document.querySelector('#spvDescBox');
detailsBox = document.querySelector('#spvDetailsBox');
mapBox = document.querySelector('#spvMapBox');


//Description tab Event Listener
document.querySelector('#spvDescTab').addEventListener('click', e =>{
    if(e.target && e.target.nodeName.toLowerCase() == 'button'){
        //Show description box
        descBox.style.display = 'block';
        //Hide detail & map box
        detailsBox.style.display = 'none';
        mapBox.style.display = 'none';
    }
});
//Detaill tab Event Listner
document.querySelector('#spvDetailsTab').addEventListener('click', e =>{
    if(e.target && e.target.nodeName.toLowerCase() == 'button'){
        //Show detail box
        detailsBox.style.display = 'block';
        //Hide description and map
        descBox.style.display = 'none';
        mapBox.style.display = 'none';
    }
});
//Map tab Event Listener
document.querySelector('#spvMapTab').addEventListener('click', e =>{
    if(e.target && e.target.nodeName.toLowerCase() == 'button'){
        //Show map box
        mapBox.style.display = 'block';
        //Hide description and detail box
        descBox.style.display = 'none';
        detailsBox.style.display = 'none';
    }
});
/**********Hover Image Display**********/
//Mouse hovered over the photo or hover box, hover box shows
document.querySelector('#spvImg').addEventListener('mouseover', () =>{
    document.querySelector('#hoverBox').style.display = 'block';
});
document.querySelector('#hoverBox').addEventListener('mouseover', () =>{
    document.querySelector('#hoverBox').style.display = 'block';
});
//Mouseout of photo && hover box, hover box hides
document.querySelector('#spvImg').addEventListener('mouseout', () =>{
    document.querySelector('#hoverBox').style.display = 'none';
});
document.querySelector('#hoverBox').addEventListener('mouseout', () =>{
    document.querySelector('#hoverBox').style.display = 'none';
});