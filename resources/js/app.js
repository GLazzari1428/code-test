require('./bootstrap');
require('@chenfengyuan/datepicker');
require('@chenfengyuan/datepicker/i18n/datepicker.pt-BR');

document.addEventListener('scroll', scrollListener);
document.addEventListener('DOMContentLoaded', initialize);

function scrollListener() {
	if (window.scrollY > 1) {
		$('body').addClass('scroll');
	}
	else {
		$('body').removeClass('scroll');
	}
}

function initialize() {
	scrollListener();
}

// Toast
window.toast = function(string, className, timeout) {
	timeout = timeout ? timeout : 4000;

	if (!$('.toast-container').length) {
		$('body').append('<div class="toast-container"></div>');
	}
	var toastId = (Math.random() + "").replace("0.", "");
	$('.toast-container').append('<div id="toast-' + toastId + '" class="toast ' + className + '">' + string + '</div>');

	var animationTimeout = 300;
	setTimeout(function() {
		$('#toast-' + toastId).addClass("toast-show");
	}, 50);

	setTimeout(function() {
		$('#toast-' + toastId).addClass("toast-hide").removeClass("toast-show");
	}, timeout + animationTimeout);

	setTimeout(function() {
		$('#toast-' + toastId).remove();
	}, timeout + animationTimeout * 2);
}
