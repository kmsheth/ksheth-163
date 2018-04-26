<?php
	include("top.html");
	include("adventure_shared.php");
	$command = $_GET["command"];
	
	$sql = "SELECT * FROM " . $command . " Limit 1000";//change this line of code to have a different query
	print "<br>" . $sql . "<br>";//displays the sql query
	$query = $db->prepare($sql); //prepares the query
	$query->execute();           //runs the query
	print_table($query);
		
	$sql = "SELECT * FROM " . $command . " where code = ?";//notice the ?
	print "<br>" . $sql . "<br>";//displays the sql query
	$query = $db->prepare($sql);//this is why prepare is useful
	$query->execute(array("USA"));//runs the query
	print_table($query);
	
	$query->execute(array("AFG"));           //rerun the query with new code
	print_table($query);
	$db = null;
	
	function print_table($query){
		print "<table border=1>\n";
		$total = $query->columnCount();
		for($counter = 0; $counter<$total; $counter++){
			$meta = $query->getColumnMeta($counter);
			print "<th>{$meta['name']}</th>\n";
			$coln[$counter] = $meta['name'];
		}
		$rows = $query->fetchAll();
		foreach($rows as $row){
			print "<tr>\n";
			for($counter = 0; $counter<$total; $counter++){
				print "<td>{$row[$coln[$counter]]}</td>\n";
			}
			print "</tr>\n";
		}
		print "</table>\n";	
	}
?>
	</body>
</html>
