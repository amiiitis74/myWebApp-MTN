function myFunction() {
  var x = document.getElementById("hiddenSide");
  if (x.className === "nav flex-column navbar-light hiddenSidebarUl") {
    x.className += " hide";
  } else {
    x.className = "nav flex-column navbar-light hiddenSidebarUl";
  }
}
