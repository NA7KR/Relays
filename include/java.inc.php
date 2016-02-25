<?php

?>
<script>
	function validate() {
		// Find the validation image div
		var validationElement = document.getElementById('nameValidation');
		// Get the form values
		var password1 = document.forms["Admin"]["password1"].value;
		var password2 = document.forms["Admin"]["password2"].value;
		// Reset the validation element styles
		
		validationElement.style.display = 'none';
		validationElement.className = 'validation-image';
		validationElement.style.display = 'inline-block';
		// Check if password2 isn't null or undefined or empty
		
		/*if (password2) {
			// Show the validation element
			validationElement.style.display = 'inline-block';
			// Choose which class to add to the element
			document.getElementById('savepasswd').disabled = true;
			validationElement.className += 
				(password1 == password2 ? ' validation-success' : ' validation-error');
		} */
		
		if  (password1 == password2)
			{
				document.getElementById('savepasswd').disabled = false;
				validationElement.className +=	' validation-success';
				document.getElementById('savepasswd').className = "inputadmin";
			}
			else
			{
				document.getElementById('savepasswd').disabled = true;
				validationElement.className +=	' validation-error';
				document.getElementById('savepasswd').className = "inputadminfalse";
			}	
		
	}

	function CheckPasswordStrength(password) {
            var password_strength = document.getElementById("password_strength");

            //TextBox left blank.
            if (password.length == 0) {
                password_strength.innerHTML = "";
                return;
            }

            //Regular Expressions.
            var regex = new Array();
            regex.push("[A-Z]"); //Uppercase Alphabet.
            regex.push("[a-z]"); //Lowercase Alphabet.
            regex.push("[0-9]"); //Digit.
            regex.push("[$@$!%*#?&]"); //Special Character.

            var passed = 0;

            //Validate for each Regular Expression.
            for (var i = 0; i < regex.length; i++) {
                if (new RegExp(regex[i]).test(password)) {
                    passed++;
                }
            }

            //Validate for length of Password.
            if (passed > 2 && password.length > 8) {
                passed++;
            }

            //Display status.
            var color = "";
            var strength = "";
            switch (passed) {
                case 0:
                case 1:
                    strength = "Weak";
                    color = "red";
                    break;
                case 2:
                    strength = "Good";
                    color = "darkorange";
                    break;
                case 3:
                case 4:
                    strength = "Strong";
                    color = "green";
                    break;
                case 5:
                    strength = "Very Strong";
                    color = "darkgreen";
                    break;
            }
            password_strength.innerHTML = strength;
            password_strength.style.color = color;
        }
	
	function showUserAccess(str) {
		if (str == "") {
			document.getElementById("txtHint").innerHTML = "";
			return;
		 } else { 
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			 }
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
				 }
			};
			xmlhttp.open("GET","getuseraccess.php?q="+str,true);
			xmlhttp.send();
		}
	}
	function showUserChange(str) {
		if (str == "") {
			document.getElementById("txtHint").innerHTML = "";
			return;
		 } else { 
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			 }
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
				 }
			};
			xmlhttp.open("GET","getuserchange.php?q="+str,true);
			xmlhttp.send();
		}
	}
</script>

<?php
?>