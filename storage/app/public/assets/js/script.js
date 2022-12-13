/*
 * Atrana
 * Modified by Zuma Akbar ID (https://rahmatwahyumaakbar.com) (https://github.com/ZumaAkbarID)
 */

/*
 * this is the javascipt for the Atrana template.
 * if you want to change, please create a new javascript, 
 * because if one is missing in the original Atrana javascript it will fall apart
 */


//preloader
$(document).ready(function () {
	setInterval(function () {
		$(".loader").hide();
		$(".loader-overlay").hide();
	}, 700);

	//sidebar toggle
	$("#sidebar-toggle, .sidebar-overlay").click(function () {
		$(".sidebar").toggleClass("sidebar-show");
		$(".sidebar-overlay").toggleClass("d-block");
	});
});


// sidebar menu dropdown
const allDropdown = document.querySelectorAll('#sidebar .side-dropdown');
const sidebar = document.getElementById('sidebar');

allDropdown.forEach(item=> {
	const a = item.parentElement.querySelector('a:first-child');
	a.addEventListener('click', function (e) {
		e.preventDefault();

		if(!this.classList.contains('active')) {
			allDropdown.forEach(i=> {
				const aLink = i.parentElement.querySelector('a:first-child');

				aLink.classList.remove('active');
				i.classList.remove('show');
			})
		}

		this.classList.toggle('active');
		item.classList.toggle('show');
	})
})
 