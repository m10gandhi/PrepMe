function storeDetails(){

  var email = document.getElementById('email').value;
  var password = document.getElementById('password').value;

  if(document.getElementById('rememberMe').checked){

    // https://www.w3schools.com/Html/tryit.asp?filename=tryhtml5_webstorage_session
    if(typeof(Storage) !== "undefined") {
      localStorage.setItem("email", email);
      localStorage.setItem("password", password);

    } else {
        showSnackbar("Sorry, your browser does not support web storage...");
    }
  }

  return true;
}




// https://www.w3schools.com/
function validateForm(){

    var password = document.getElementById('password').value;

    var validateName = /^[A-Za-z]+$/;

    if (validateName.test(password) || password.length < 8 || password.toLowerCase() == password){
      showSnackbar("Password validation failed");
      document.getElementById("mpassword").className = "form-group has-error has-feedback";
      return false;
    }
    else {
      document.getElementById("mpassword").className = "form-group has-success has-feedback";
      return true;
    }

  }

function showSnackbar(message){
  var snackbar = document.getElementById("snackbar");
  document.getElementById("snackeyText").innerHTML = String(message);
  snackbar.className = "show";
  setTimeout(function(){ snackbar.className = snackbar.className.replace("show", ""); }, 3000);
}
