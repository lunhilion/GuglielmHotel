window.onload = function() {
  var toggled = false;
  var menuToggle = document.getElementById('naventry-menu');
  var mobileNavbar = document.getElementById('mobilenavbar');
  menuToggle.addEventListener('click', function() {
    mobileNavbar.style.visibility = toggled ? 'hidden' : 'visible';
    mobileNavbar.style.opacity = toggled ? '0' : '1';
    mobileNavbar.style.position = toggled ? 'absolute' : 'relative';
    toggled = !toggled;
  });
};
