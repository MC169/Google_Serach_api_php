<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
<script src="./myapi/search.js" type="text/javascript"></script>
<link href="style.css" rel="stylesheet" type="text/css"/>

<form action="" method="post">
	<h1 style="textalign:center;margin-top:50px;">googlesearch<h1>
	<input type="text" id="searchfield" name="searchfield" placeholder="news"  onkeydown="if(event.keyCode == 13) searchapi(this.id, 'SearchResponse');">
	<input type="button" name="search" value="suche starten" onclick="searchapi('searchfield', 'SearchResponse');">
	<ul id="SearchResponse" class="responselist"><!-- automatically filled --></ul>
</form>
