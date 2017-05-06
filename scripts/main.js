/*functions that will validate form input*/

//validate year
function validYear(year) {
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

//will change the text to the current error
function msg(id, error){
	console.log("id is" , id);
	$("#" + id).text(error);
}