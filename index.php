<?php
include("top.html");
include("adventure_shared.php");
?>

    <p>Welcome to the Adventure Recommender -- the web site for discriminating traveller
	needing ideas! Choose the demographics of a place you'd like to visit and we'll
	recommend countries for you to adventure to!</p>

    <form action="adventure_recommendations.php" method="get">
      <div>
        <h2>Which continent(s) do you prefer to travel to?</h2>

        <select name="continent[]" size="5" multiple="multiple">
        <option value="Anywhere" selected='selected'>Anywhere</option>
        	<?php //from here
			$sql = "SELECT DISTINCT continent FROM countries ORDER BY continent";
			$query = $db->prepare($sql); //prepares the query
			$query->execute();	//runs the query
			$rows = $query->fetchAll();
			foreach($rows as $row){
				$choice = $row["continent"];
				?>
				<option value="<?= $choice ?>"><?= $choice ?></option><?php
			}
			?>
        </select>
	  </div>
      <div>	  
        <h2>Which language(s) do you prefer?</h2>
        <select name="languages[]" size="12" multiple="multiple">
        <option value="Any Language" selected='selected'>Any Language</option>
        	<?php 
			$sql = "SELECT DISTINCT language FROM languages ORDER BY language";
			$query = $db->prepare($sql); //prepares the query
			$query->execute();	//runs the query
			$rows = $query->fetchAll();
			foreach($rows as $row){
				$choice = $row["language"];
				?>
				<option value="<?= $choice ?>"><?= $choice ?></option><?php
			}
			?>
        </select>
      </div>
      <div>
		<h2>Do you prefer a developed or undeveloped country</h2>
		<input type="radio" name="development" value="developed">Developed
		<input type="radio" name="development" value="developing">Developing
		<input type="radio" name="development" value="either" checked="true">Don't Mind<br>
      </div>	  
      <div>
        <input type="submit" value="Submit" /> 
      </div>
    </form>
	<form action="screenshot1.html" method="get">
	<input type="submit" value="Adventure Screenshot" />
	</form>
	<form action="data.php" method="get">
	<input type="submit" name="command" value="cities" />
	<input type="submit" name="command" value="countries" />
	<input type="submit" name="command" value="languages" />
	</form>	
  </body>
</html>
