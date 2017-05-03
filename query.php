<?php

$string = file_get_contents("films.json", FILE_USE_INCLUDE_PATH);
$brut = json_decode($string, true);
$films = $brut["feed"]["entry"]; 

foreach ($films as $film) {
	echo "INSERT INTO `movies` (`title`,`summary`,`director`,`category`, `release_date`, `poster`) VALUES ('".rrr($film['im:name']['label'])
	."','".rrr($film['summary']['label'])."','"
	.$film["im:artist"]['label']."','"
	.$film['category']['attributes']['label']
	."', '".$film["im:releaseDate"]['attributes']['label']
	."', '".$film['im:image'][0]['label']."');\n";
}

function rrr($streng){
	return str_replace("'", " ", $streng);
}
?>