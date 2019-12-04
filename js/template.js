const hamburgerMenu = document.querySelector('#burger');
console.log("hamburger menu");
hamburgerMenu.addEventListener('click', e => {
    if (e.target && e.target.nodeName.toLowerCase() == 'div') {
        const nav = document.querySelector('#navigation');
        console.log('click');
        if (nav.style.display === 'block') {
            nav.style.display = 'none';
        } else {
            nav.style.display = 'block';
        }
    }
});
