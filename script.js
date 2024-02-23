$("[type='file']").bind("on change", function (e) {
	$(this)
		.closest(".imageUploadContainer")
		.find("img")
		.attr("src", URL.createObjectURL(e.target.files[0]))
		.on(function () {
			URL.revokeObjectURL($(this).src);
		});
});
document.addEventListener("DOMContentLoaded", function () {
	var currentPage = window.location.pathname;
	currentPage = currentPage.split("/").slice(-1).join("/");
	const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");
	allSideMenu.forEach((item) => {
		if (item.getAttribute("href") === currentPage) {
			item.parentElement.classList.add("active");
		}
		item.addEventListener("click", function () {
			allSideMenu.forEach((i) => {
				i.parentElement.classList.remove("active");
			});
			item.parentElement.classList.add("active");
		});
	});
});
// TOGGLE SIDEBAR
const menuBar = document.querySelector("#content nav .bx.bx-menu");
const sidebar = document.getElementById("sidebar");
const brand = document.querySelector(".brand");
menuBar.addEventListener("click", function () {
	sidebar.classList.toggle("hide");
	if (sidebar.classList.contains("hide")) {
		// Sidebar is hidden
		// Add CSS to .brand when toggle is closed
		brand.style.fontSize = "0";
		brand.style.marginLeft = "0";
	} else {
		// Sidebar is shown
		// Add CSS to .brand when toggle is open
		brand.style.fontSize = "24px";
		brand.style.marginLeft = "1.5em";
	}
});
const searchButton = document.querySelector(
	"#content nav form .form-input button"
);
const searchButtonIcon = document.querySelector(
	"#content nav form .form-input button .bx"
);
const searchForm = document.querySelector("#content nav form");
searchButton.addEventListener("click", function (e) {
	if (window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle("show");
		if (searchForm.classList.contains("show")) {
			searchButtonIcon.classList.replace("bx-search", "bx-x");
		} else {
			searchButtonIcon.classList.replace("bx-x", "bx-search");
		}
	}
});
if (window.innerWidth < 768) {
	sidebar.classList.add("hide");
} else if (window.innerWidth > 576) {
	searchButtonIcon.classList.replace("bx-x", "bx-search");
	searchForm.classList.remove("show");
}
window.addEventListener("resize", function () {
	if (this.innerWidth > 576) {
		searchButtonIcon.classList.replace("bx-x", "bx-search");
		searchForm.classList.remove("show");
	}
});
const switchMode = document.getElementById("switch-mode");
switchMode.addEventListener("change", function () {
	if (this.checked) {
		document.body.classList.add("dark");
	} else {
		document.body.classList.remove("dark");
	}
});