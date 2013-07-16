<!DOCTYPE HTML>
<html>
<head>
	<title>cLOUD</title>
	<style>
		h1{
			margin: 0%44%;
			color: darkblue;
			font-family:verdana;
			font-size: 45px;
		}
		a:link{color:blue;}
		a:visited{color:black;}
		a:hover{color:purple;}
		a{font-size: 20px;}
		

		form{
			 font-size: 17px;
			 font-family: cursive;
			 background:lightblue; 
			 margin:13%38%;
			 padding:30px 18px;
		    }


		

	</style>
</head>
<body>
<h1> cLOUD </h1>
<p>
	<a href="upload.view.php"><b>Upload Music</b></a><br>
</p>
<hr>

<form action="index.php" method="post" id="search">

<select name="key">
<option value="Title" selected>Title</option>
<option value="Artist">Artist</option>
<option value="Album">Album</option>
</select>

<input type="text" name="val" value="Search">
<audio id="player" controls>
	Your browser does not support HTML5 Audio
</audio>

</form>
<br>
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

require_once 'database.controller.php';
require_once 'helper.class.php';

$HELP = new Helper();
$DB = new DBController("127.0.0.1","root","","music");

$result = $DB->search($_POST["key"], $_POST["val"]);

for ($i=0; $i < count($result); $i++) { 
	
	echo "<a href=\"javascript:setSrc('" . $result[$i]['Path'] . "');\">" . $result[$i]['Title'] . "&nbsp; &nbsp; &nbsp;" .  $result[$i]['Artist'] . "&nbsp; &nbsp; &nbsp;" . $result[$i]['Album'] . "</a><br>";
}

}
?>

<br><hr>



<script type="text/javascript">

var audio = document.getElementById('player');

function setSrc(src)
{
	audio.src = src;
	audio.play();
}

</script>

</body>
</html>