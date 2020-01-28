<?php
// get required files for Google API
require('../simple_html_dom.php');

// check post input
if(empty($_POST['searchString'])){
	echo "";
}else{
	// set variable with post value
	$value = $_POST['searchString'];
	$key = "AIzaSyB5y1hQzacJB0GnhGc8udgPKNiPd434KuA";
	$cx = "003049107446002617233:qsw352odsxb";
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, 'https://www.googleapis.com/customsearch/v1?key='.$key.'&cx='.$cx.'&q='.$value);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, True);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);
	$result = curl_exec($curl);
	
	//echo ($result);

		
	curl_close($curl);
	
	
	//Create file
	if (!file_exists("$value.json")){
		file_put_contents("$value.json", $result);
		
		$json = file_get_contents("$value.json");
	
		print $json;	
	}else {
		//offlinesearch
		$p = "$value.json";
		
		$myfile = fopen($p,"r");
		echo fread($myfile, filesize("$p"));	
	}	
	
	$domResults = new simple_html_dom();
	$domResults->load($result);
	// allocate response string variable
	$response = ""; // TODO maybe make an error message tag or so on
	// get all results from object
	foreach($domResults->find('a[href^=/url?]') as $link){
		// ..if there is something
		if(!empty($link->plaintext)){
			// add new to response string
			$response = $response."<li><div class='responseelement'>".$link->plaintext."</div></li>";
		}
	}
	// is there a resopnse
	if($response != ""){
		// ...yes there is send string back to jquery callback
		echo $response;
	}else{
		// send empty (later displayed in error field)
		echo "";
	}
}


?>
