
function loginhash(form, password) {
    // Makes a new field to submit the hashed password 
    var pass = document.createElement("input");
	form.appendChild(pass);
    pass.name = "pass";
    pass.type = "hidden";
	
	// Hashes the pasword.
    pass.value = hex_sha512(password.value);

    // removes the unencripted password befor submission
    password.value = "";
	form.submit();
}
function resetformhash(form, email, salt, password, confirmpwd) {
    // Check each field has a value
    if (password.value == '' || confirmpwd.value == '') {
        alert('FILL THEM BOTH OUT...');
        return false;
    }
    if (password.value.length < 6) {
        alert('yOUR PASSWORD IS TOO SHORT. IT NEEDS TO BE 6 AT LEAST 6 CHARACTERS');
        form.password.focus();
        return false;
    }
     
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('NEEDS AT LEAST ONE NUMBER, ONE UPPERCASE, AND ONE LOWERCASE');
        return false;
    }
    
    if (password.value != confirmpwd.value) {
        alert('THEY DONT MATCH..');
        form.password.focus();
        return false;
    }
        
    var pass = document.createElement("input");
	form.appendChild(pass);
    pass.name = "pass";
    pass.type = "hidden";
    pass.value = hex_sha512(password.value);

    password.value = "";
    confirmpwd.value = "";

    form.submit();
    return true;
}
