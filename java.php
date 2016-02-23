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
		// Check if password2 isn't null or undefined or empty
		document.getElementById('savepasswd').disabled = true;
		if (password2) {
			// Show the validation element
			validationElement.style.display = 'inline-block';
			// Choose which class to add to the element
			document.getElementById('savepasswd').disabled = false;
			validationElement.className += 
				(password1 == password2 ? ' validation-success' : ' validation-error');
		}
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