<?php

class Model
{
	public $connection;
	
	public function __construct()
	{
		$servername = "sql309.infinityfree.com";
		$username = "if0_38135779";  // Default username for XAMPP
		$password = "N3FpmATwIAe0mja";      // Default password for XAMPP (empty string)
		$dbname = "if0_38135779_db_project_journal"; // Database name
		
		$this->connection = new mysqli($servername, $username, $password, $dbname);
		
		if ($this->connection->connect_error) {
		    die("Database Connection Error: " . $this->connection->connect_error);
		}
	}

	public function insertData ($table, $insertArray)
	{
		$key = implode (",", array_keys($insertArray));
		$value = implode ("','", array_values($insertArray));
		$query = "INSERT INTO $table ($key) VALUES ('$value') ";
		$res = $this -> connection -> query ($query);
		return $res;
	}

	public function selectData ($table)
	{
		$query = "SELECT * FROM $table";
		$res = $this -> connection -> query ($query);
		while ($row = $res -> fetch_object())
		{
			$rw[] = $row;
		}
		return $rw ?? [];
	}

	public function selectOne ($table, $where)
	{
		$query = "SELECT * FROM $table WHERE 1=1";
		foreach($where as $key => $value)
		{
			$query.=" AND ".$key."='".$value."'";
		}
		$res = $this -> connection -> query ($query);
		$rw = $res -> fetch_object();
		return $rw ?? [];
	}
	
	public function updateData ($table, $setArray, $where)
	{
		$query = "UPDATE $table SET";
		$count = count ($setArray);
		$i=0;
		foreach($setArray as $key => $value)
		{
			if($i < $count -1)
			{
				$query.= " " .$key. " = '".$value."', ";
			}
			else
			{
				$query.= " " .$key. " = '" .$value."' ";
			}
			$i++;
		}
		$query.= " WHERE 1=1 ";
		foreach($where as $key => $value)
		{
			$query.= " AND " .$key. " = '" .$value. "' ";
		}
		// echo "<pre>$query</pre>";
		$res = $this -> connection -> query ($query);
		return $res;
	}

	public function deleteData ($table, $where)
	{
		$query = "DELETE FROM $table WHERE 1=1";
		foreach($where as $key => $value)
		{
			$query.= " AND $key = '$value'";
		}
		$res = $this -> connection -> query ($query);
		return $res;
	}
	
}

?>
