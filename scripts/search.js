
//still deciding if we want to use JavaScript compared to PHP
function login(username, hash_password) {
	//parameters should be fetched from forms using PHP and passed into this js function

	var request = $.ajax({
		type: 'GET',
		url: "data/login.json",
		dataType: "json"
	}); // will use mysqli object in PHP to get the login data from 
	    //the table to store in the login.json

	request.done(function(data) {
		var loginArray = $.map(data, function(value, index) {
			return [value];
		});

		//array should now be accessible like loginArray['username'] and loginArray['hash_password']
		if (loginArray['username'] == username && loginArray['hash_password'] == hash_password) 
			return true;
		else
			return false;
		//will return a boolean for isLoggedIn to enable to disable admin privileges
	}
}

function search(query) {
	//parameters should be fetched from the search form using PHP and passed into this js function

	//events = eventSearch(query);
	//first calls function eventSearch(query), which will look almost identical to this function
	//eventSearch(query) will return back the events in an array. The indices will be the eventIDs

	var request = $.ajax({
		type: 'GET',
		url: "data/albums.json",
		dataType: "json"
	}); // will use mysqli object in PHP to get the albums from 
	    //the table to store in the albums.json

	    //example of album json object
	    /*
	    {
			"data": [
				{
					"album_id": "1",
					"year": "2015",
					"participant_list": "Jenny Wang, Willis Guo, Fangru Jiang",
					"feedback": "\"Great event!\" - Jenny Wang",
					"venue": "Hollister Hall",
					"event_id": "1"
				},
				... //more albums
			]
	    }
	    */

	request.done(function(data) {
		var results = [];
		var albumArray = $.map(data.data, function) {
			return [value];
		});

		albumArray.forEach(function(album) {
			if (album.album_id == query || album.year == query || events.hasOwnProperty(parseInt(album.album_id)))
				albumArray.push(album.album_id);
		});
	});
}
