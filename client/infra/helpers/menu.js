window.onload = function() {
    document.getElementsByClassName('left-menu-toggle')[0].addEventListener('click', function(){
	document.getElementsByClassName('left-menu-toggle')[0].classList.toggle('active');
	document.getElementsByClassName('left-menu')[0].classList.toggle('left-menu-showed');
	document.getElementsByClassName('main-backdrop')[0].classList.toggle('main-backdrop-showed');

    });

};
