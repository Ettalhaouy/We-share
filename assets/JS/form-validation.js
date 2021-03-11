var inputEmail = document.getElementById("inputEmail");
var myInput = document.getElementById("inputPassword");
var myInput2 = document.getElementById("inputPassword2");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the Email field, show the emailError box
inputEmail.onfocus = function() {
    document.getElementById("emailErrorMsg").style.display = "block";
}
  
// When the user clicks outside of the Email field, hide the emailError box
inputEmail.onblur = function() {
    document.getElementById("emailErrorMsg").style.display = "none";
}
// When the user starts to type something inside the Email field
inputEmail.onkeyup = function() {
    // Validate Email Format
    var emailFormat = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if(inputEmail.value.match(emailFormat)) {
        emailError.classList.remove("invalid");
        emailError.classList.add("valid");
    } else {
        emailError.classList.remove("valid");
        emailError.classList.add("invalid");
    }
}


// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
    }

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }

}
// When the user clicks on the  Confirme password field, show the message2 box
  myInput2.onfocus = function() {
    document.getElementById("message2").style.display = "block";
  }
  
  // When the user clicks outside of the Confirme password field, hide the message2 box
  myInput2.onblur = function() {
    document.getElementById("message2").style.display = "none";
  }
  
  // When the user starts to type something inside the confirme password field
  myInput2.onkeyup = function() {
    // Validate matching
   if (myInput.value == myInput2.value) {
    pwdMatch.classList.remove("invalid");
    pwdMatch.classList.add("valid");
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }
  }
  //Validate button
    hideButton();
    function hideButton(){
      var button = document.getElementById("signUpBtn");
      if(myInput.value.match(lowerCaseLetters) && myInput.value.match(upperCaseLetters) && myInput.value.match(numbers) && myInput.value.length >= 8 && myInput.value == myInput2.value){
        button.disabled = false;
      }else{ 
        button.disabled = true;

      }
    }
