// in case ajax request start rotating curser Animation
$(document).ajaxStart(function () {
	// show cursor
	$('html').addClass('loading');
}).ajaxStop(function () {
	// hide cursor
	$('html').removeClass('loading');
});

// old results array for checking later is existing
var oldresults = [];

/*
*	Search a string by Google Search - by API
*
*	param: inputID 		= input element ID
*	param: responseID 	= response element ID 
*/
function searchapi(inputID, responseID){
	// get the search string from input element 
	var searchString = document.getElementById(inputID).value;
	// check search string
	if(searchString != null && searchString != ""){		
		// get list element for response by id
		var elementlist = document.getElementById(responseID);
		// get all elements are remebered with the search string
		const result = oldresults.find( ({ str }) => str === searchString );	
		// if the search string not exist in object array get new data
		if(result == null){
			//console.log("API value Ajax: " + searchString); 
			// start ajax - send json
			$.ajax({
					url: "./myapi/search.php",
					type: "POST",
					datatype: "json",
					data: { searchString: searchString },
					success: function (response) {
						var data = response;
						if(data != null && data != ""){							
							//console.log("Ready loading search by api: " + data);	
							// fill list
							elementlist.innerHTML = data;
							// write new search console as object to result object list
							oldresults.push({str: searchString, d: data});
						}else{
							// TODO write error to error field or not .... ?
							console.log("No response value");
						}          
					},
					error: function(jqXHR, textStatus, errorThrown) {
					   console.log(textStatus, errorThrown);
					   // fill error in element list
					   elementlist.innerHTML = "<li>Nothing found</li>";
					   // TODO write error to error field or not .... ?
					}
				});
		}else{
			//console.log("Is existing so get from cache");
			// if found in cacheing data object list, get the cashed data			
			elementlist.innerHTML = result.d;
		}
	}
	else{
		// search string errors
		console.log("No input in Search field");
		// TODO - maybe write error to error field or not .... ?
	}
}
