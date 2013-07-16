<!DOCTYPE HTML>
<html>
<head>
	<title>MCLoud</title>
	<style>
		h1{
			color: darkblue;
			font-family:verdana;
		  }
		
		a{font-size: 23px;}
		a:link{color:blue;}
		a:visited{color:darkblue;}
		a:hover{color:purple;}

		#textbox1{ margin-left: 8px;}
		#textbox2{ margin-left: 8px;}
		#textbox3{ margin-left: 8px;}
		#file{margin-left: 8px}
		form{
			  font-size: 17px;
			  font-family: cursive;
			 background:lightblue; 
			 margin:13%38%;
			 padding:2%5%;
		 	}


	</style>
</head>
<body>

<form action="upload.view.php" method="post"
enctype="multipart/form-data" id="upload">

	<label for="file">Filename:</label>
	<input type="file" name="file" id="file"><br>

	<label for="title">Title:</label>
	<input type="text" name="title" id="textbox1"><br>

	<label for="artist">Artist:</label>
	<input type="text" name="artist" id="textbox2"><br>

	<label for="album">Album:</label>
	<input type="text" name="album" id="textbox3"><br><br>

	<input type="submit" name="submit" value="Upload..." id="upload"><br>

	<p>
	      <a href="index.php"><b>Player</b></a><br>
    </p>

</form>

<!-- Server response -->
<?php
require_once 'helper.class.php';
require_once 'database.controller.php';

$HELP = new Helper();
$DB = new DBController("127.0.0.1","root","","music");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	

	//Validate form
	if($_FILES["file"]["error"] == 4)
	{
		$HELP->errorMessage("Select a valid file");
	}

	if($_FILES["file"]["error"] == 0 && strlen(trim($_POST["title"])) > 0 && strlen(trim($_POST["artist"])) > 0 && strlen(trim($_POST["album"])) > 0)
	{
		//Upload controller
		require_once 'uploader.php';
		$U = new Uploader("uploads");

		$result = $U->upload($_FILES);

		if($result == false || substr($result, 0, 5) == "ERROR")
			$HELP->errorMessage("An error occured: " . substr($result, 5));
		else{
			echo "<p>Saved to " . $result . "</p>";

			echo $DB->insert($_POST["title"], $_POST["artist"], $_POST["album"], $result);
		}
	}
	else
		echo $HELP->errorMessage("All fields compulsary");
}
?>
<!-- Server response -->

</body>
</html>