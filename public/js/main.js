

jQuery(document).ready(function($) {
  $('.navbar-nav.mr-3 li a.nav-link.nav-link-lg.collapse-btn').click(function(){
    $('.mini-logo img').toggle();
  });
   $('.navbar-nav.mr-3 li a.nav-link.nav-link-lg.collapse-btn').click(function(){
    $('.main-sidebar .sidebar-menu li .menu-toggle').toggleClass('add');
  });
});

// Hide Show Password JS
let passwordInput = document.getElementById('txtPassword'),
toggle = document.getElementById('btnToggle'),
icon =  document.getElementById('eyeIcon');

function togglePassword() {
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    icon.classList.add("fa-eye-slash");
    //toggle.innerHTML = 'hide';
  } else {
    passwordInput.type = 'password';
    icon.classList.remove("fa-eye-slash");
    //toggle.innerHTML = 'show';
  }
}
toggle.addEventListener('click', togglePassword, false);
passwordInput.addEventListener('keyup', checkInput, false);


// Disable Browser

document.onkeydown = function(e) {
if(event.keyCode == 123) {
    return false;
}
if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
    return false;
}
if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
    return false;
}
if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
    return false;
}
if(e.ctrlKey && e.keyCode == 'C'.charCodeAt(0)){
    return false;
}
if(e.ctrlKey && e.keyCode == 'X'.charCodeAt(0)){
    return false;
}
if(e.ctrlKey && e.keyCode == 'Y'.charCodeAt(0)){
    return false;
}
if(e.ctrlKey && e.keyCode == 'Z'.charCodeAt(0)){
    return false;
}
if(e.ctrlKey && e.keyCode == 'V'.charCodeAt(0)){
    return false;
}
if (e.keyCode == 67 && e.shiftKey && (e.ctrlKey || e.metaKey)){
    return false;
}
if (e.keyCode == 'J'.charCodeAt(0) && e.altKey && (e.ctrlKey || e.metaKey)){
    return false;
}
if (e.keyCode == 'I'.charCodeAt(0) && e.altKey && (e.ctrlKey || e.metaKey)){
    return false;
}
if ((e.keyCode == 'V'.charCodeAt(0) && e.metaKey) || (e.metaKey && e.altKey)){
    return false;
}
if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)){
    return false;
}
if(e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)){
    return false;
}
if(e.ctrlKey && e.keyCode == 'H'.charCodeAt(0)){
    return false;
}
if(e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)){
    return false;
}
if(e.ctrlKey && e.keyCode == 'F'.charCodeAt(0)){
    return false;
}
if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){
    return false;
}
}
if (document.addEventListener) {
    document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
    }, false);
}else{
    document.attachEvent('oncontextmenu', function() {
    window.event.returnValue = false;
    });
}
