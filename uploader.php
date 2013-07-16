<?php

class Uploader
{
	private $baseDir;

	function __construct($dir)
	{
		$this->baseDir = $dir;
	}

	function upload($FILES)
	{
		$allowedExts = array("mp3", "ogg", "wav");
		$t = explode(".", $FILES["file"]["name"]);
    $extension = end($t);

		$error = false;

		$baseDir = $this->baseDir;

		if (in_array($extension, $allowedExts))
  		{
  			if ($FILES["file"]["error"] > 0)
    		{
    			$error = $FILES["file"]["error"];
    			return "ERROR File Error: " . $error;
    		}
  			else
    		{
			    if (file_exists($baseDir . "/" . $FILES["file"]["name"]))
      			{
      				$error = "ERROR EXISTS";
      				return $error;
      			}
    			else
      			{
      				if(move_uploaded_file($FILES["file"]["tmp_name"], $baseDir . "/" . $FILES["file"]["name"]))
      					return $baseDir . "/" . $FILES["file"]["name"];
      				else
      					return "ERROR Move error to " . $baseDir . "/" . $FILES["file"]["name"];
      			}
    		}
  		}
		else
  		{
  			return "ERROR Invalid file type";
  		}
	}
}

?>