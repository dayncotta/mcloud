<?php

class DBController{

	private $connection;

	function __construct($host, $user, $pass, $database)
	{
		$this->connection = mysqli_connect($host, $user, $pass, $database);
	}

	//insert accepted parameters into table
	function insert($title, $artist, $album, $path)
	{

		// Create connection
		$con = $this->connection;

		// Check connection
		if (mysqli_connect_errno($con))
  		{
  			return mysqli_connect_error();
  		}
  		else{

			$title = mysql_real_escape_string($title);
			$artist = mysql_real_escape_string($artist);
			$album = mysql_real_escape_string($album);
			$path = mysql_real_escape_string($path);

			mysqli_query($con,"INSERT INTO song (Title, Artist, Album, Path) VALUES('$title','$artist','$album', '$path')");
			return true;
		}

	}

	function search($key, $value)
	{
		$conn = $this->connection;
		$query = "SELECT * FROM song where " . $key . " LIKE '%" . $value . "%' ";

    	if (mysqli_connect_errno()) 
    	{
     		return mysqli_connect_error();
    	}
    	else
    	{ 
    		$list = array();
    		if(strlen(trim($key)) > 0 && strlen(trim($value)) > 0)
    		{
    			$result = mysqli_query($conn, $query);

    			while($row = mysqli_fetch_array($result) ) 
         		{
     				$list[] = $row;
     	 		}
         
     		return($list);
    	}
   	else
      return false;
	}
}

function getRow($id)
{
	$conn = $this->connection;

    if (mysqli_connect_errno()) 
    {
    	return mysqli_connect_error();
    }
    else
    {
     	$list = array();

    	if($id != null && strlen(trim($id)) > 0)
    	{
    		$id = intval($id); 
    		$result = mysqli_query($conn," SELECT * FROM song where ID = '" . $id . "' ");

    		while($row = mysqli_fetch_array($result) ) 
         	{
     			$list[] = $row;
     	 	}

   			 return($list);
   		}
   		else
   			return false;
   	}
  }

}

?>