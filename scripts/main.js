/*functions that will validate form input*/

//validate year
// 	-album year
// 	-member year
// 
function validYear(year){
	if (year == "") {
		msg("yearmsg","Required");
		return false;
	} else if (/^[0-9]{4}$/.test(year)) {
		msg("yearmsg","");
		return true;
	} else {
		msg("yearmsg","Year must be 4 numbers");
		return false;
	}
	return true;
}

/*

//add Album + addEvent
used for validating 
	- participant list, venue 
	- eventName, event description, event history*/
function validText(err, input){
	if (input == ""){
		msg(error, "Required");
		return false;
	}
	else if (/^[a-zA-Z0-9_]*$/.test(input)){
		msg(err, "");
		return true;
	}
	else {
		msg(err, "Must be valid text");
		return false;
	}
	return true;
}

//validating feedback which may contain .,"!*&$%#
function validFeedback(err,input){
	if (input == ""){
		msg(error, "Required");
		return false;
	}
	else if(/^[A-Za-z0-9_~\-,!\"\&\(\) ]+$/.test(input)){
		msg(err,"");
		return true;
	}
	else {
		msg(err, "Must be valid feedback");
		return false;
	}
	return true;
} 

// add Member 
function validingName (err, input) {
	if (input == ""){
		msg(error, "Required");
		return false
	}
	else if (/^[a-zA-Z]+[-a-zA-Z]$/.test(input)){
		//set err to none
		return true
	}
	else {
		msg(err, "Must be valid name");
		return false;
	}
	return true;
}


//will change the text to the current error
function msg(id, error){
	console.log("id is" , id);
	$("#" + id).text(error);
}
