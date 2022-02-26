const body = document.getElementsByTagName("body")[0];

function collapseSidebar() {
  body.classList.toggle("sidebar-expand");
}
function openCalender() {
  body.classList.toggle("open-calendar");
}
function closeCalender() {
  document.getElementById("date-close").innerHTML =
    document.getElementById("date");
}
window.onclick = function (event) {
  openCloseDropdown(event);
};

function closeAllDropdown() {
  var dropdowns = document.getElementsByClassName("dropdown-expand");
  for (var i = 0; i < dropdowns.length; i++) {
    dropdowns[i].classList.remove("dropdown-expand");
  }
}

function openCloseDropdown(event) {
  if (!event.target.matches(".dropdown-toggle")) {
    //
    // Close dropdown when click out of dropdown menu
    //
    closeAllDropdown();
  } else {
    var toggle = event.target.dataset.toggle;
    var content = document.getElementById(toggle);
    if (content.classList.contains("dropdown-expand")) {
      
      closeAllDropdown();
    } else {
      closeAllDropdown();
      content.classList.add("dropdown-expand");
    }
  }
}

function waitForLoad(id, callback) {
  var timer = setInterval(function() {
      if (document.getElementById(id)) {
          clearInterval(timer);
          callback();
      }
  }, 100);
}

waitForLoad("Cancel-button", function() {
  document.getElementById("Cancel-button").onclick = function() {
      waitForLoad("myModal", function() {
          document.getElementById("myModal").style.display = "flex";
      });
  };
});

function waitForLoad(id, callback) {
  var timer = setInterval(function() {
      if (document.getElementById(id)) {
          clearInterval(timer);
          callback();
      }
  }, 100);
}

waitForLoad("close", function() {
  document.getElementById("close").onclick = function() {
      document.getElementById("myModal").style.display = "none";
  };
});

// window.onclick = function (event) {
//   if (event.target == document.getElementById("modal-container") ) {
//     document.getElementById("modal-container").style.display = "none";
//   }
// }


function rescheduleAppointment() {
  var x = document.getElementById("rescheduleAppointment");
  var y = document.getElementById("cancelIssue");

  if (x.style.display === "none") {
    x.style.display = "table";
    y.style.display = "none";
  } else {
    x.style.display = "none";
  }
}


