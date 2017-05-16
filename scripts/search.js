$(document).ready(function () {
    $('#search-text').keyup(function () {
        console.log("calling search");
        search($('#search-text').val());
    });
});


////event name, year, and venue of albums
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
        $(".gallery").empty();
		var result = [];
        console.log(data.data);
		var albumArray = $.map(data.data, function(value, index) {
			return [value];
		});

		albumArray.forEach(function(album) {
            console.log(query);
            console.log(album.name);
            console.log(album.name.match(query));
            
            var containsName = album.name.toLowerCase().indexOf(query.toLowerCase()) > -1;
            var containsVenue = album.venue.toLowerCase().indexOf(query.toLowerCase()) > -1;
            
			if ((containsName || album.year.match(query) || containsVenue) && album.cover_photo != "N/A" ) { 
                $('.gallery').append(albumRender(album));
            }
		});
	});
    
    request.fail(function (xhr, textStatus, errorThrown) {
        console.log(xhr.responseText);
    });
}

function albumRender(album) {
    return "<div class='album-container'>" +
                "<a class='unstyled-link' href=album.php?aid=" + album.album_id + ">" + 
                    "<img src=img/" + album.cover_photo + ">" +
                     "<span class='deets'><span>Learn More</span></span>" + 
                "</a>" +
                "<h2 class='album-title'>" + album.name + "</h2>    " + album.year +
            "</div>";
}