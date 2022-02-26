const body = document.getElementsByTagName('body')[0]

function collapseSidebar() {
	body.classList.toggle('sidebar-expand')
}
function openCalender(){
    body.classList.toggle('open-calendar')
    
}
function closeCalender(){
    document.getElementById("date-close").innerHTML = document.getElementById("date");
}
window.onclick = function(event) {
	openCloseDropdown(event)
}

function closeAllDropdown() {
	var dropdowns = document.getElementsByClassName('dropdown-n-expand')
	for (var i = 0; i < dropdowns.length; i++) {
		dropdowns[i].classList.remove('dropdown-n-expand')
	}
}

function openCloseDropdown(event) {
	if (!event.target.matches('.dropdown-n-toggle')) {
		// 
		// Close dropdown when click out of dropdown menu
		// 
		closeAllDropdown()
	} else {
		var toggle = event.target.dataset.toggle
		var content = document.getElementById(toggle)
		if (content.classList.contains('dropdown-n-expand')) 
        {
			closeAllDropdown()
		} 
        else {
			closeAllDropdown()
			content.classList.add('dropdown-n-expand')
		}
	}
}

function bookSlot()
{
    body.classList.toggle('booking');    
}


	
	