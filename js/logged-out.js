/**
 * Javascript for buttons on index (not logged in) PHP
 * The Login button directs to login.php
 * The Join button directs to signUp.php
 * 
 */
//For Login button
document.querySelector('#login').addEventListener('click', e => {
    window.location.href = 'login.php';
});
//For Join button
document.querySelector('#join').addEventListener('click', e => {
    window.location.href = 'signUp.php';
});