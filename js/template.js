/**
 * This Javascript is for the hamburger navigation (Media Query: 800px)
 */
const hamburgerMenu = document.querySelector('#burger');
hamburgerMenu.addEventListener('click', e => {
    if (e.target && e.target.nodeName.toLowerCase() == 'div') {
        const nav = document.querySelector('#navigation');
        if (nav.style.display === 'block') {
            nav.style.display = 'none';
        } else {
            nav.style.display = 'block';
        }
    }
});
