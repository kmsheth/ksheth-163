<?php
include("top.html");
include("adventure_shared.php");
?>

	<br>
	<p>Thanks for your submission!</p>
	<h2> Your preferences for your next adventure were to go to a country...</h2>
	<p>...in the following continents:</p>
	<?php
		print_continents();
	?>
	<p>...where they speak the following languages:</p>
	<?php
		print_languages();
	?>
	<p>...and has a <?php print_economy(); ?> economy</p>

    <h2>Countries that fit your preferences for your next adventure are:</h2>
	<?php
		print_countries();
	?>
	<form action="screenshot2.html" method="get">
	<input type="submit" value="Adventure Screenshot" />
	</form>
  </body>
</html>

<?php
function print_continents() {
	$continents = $_GET["continent"];
	?>
	<ul>
	<?php
		foreach($continents as $continent){
	?>
		<li><?= $continent ?></li>
	<?php
		}
	?>
	</ul>
<?php
}
function print_countries() {
include("adventure_shared.php");
	$languages = $_GET["languages"];
	$continents = $_GET["continent"];
	$development = $_GET["development"];
	foreach($languages as $language) {
		foreach($continents as $continent) {
			if ($development == "developed" && $language != "Any Language" && $continent != "Anywhere") {
				$sql = "SELECT DISTINCT countries.Name FROM countries, languages WHERE languages.Language = '" . $language . "' AND countries.GNP >= 10000 AND countries.Continent = '" . $continent . "' AND countries.LifeExpectancy > 62 AND languages.CountryCode = countries.Code ORDER BY countries.Name;";
			}
			elseif ($development == 'developing' && $language != 'Any Language' && $continent != 'Anywhere') {
				$sql = "SELECT DISTINCT countries.Name FROM countries, languages WHERE languages.Language = '" . $language . "' AND countries.GNP < 10000 AND countries.LifeExpectancy < 62 AND countries.Continent = '" . $continent . "' AND languages.CountryCode = countries.Code ORDER BY countries.Name;";
			}
			elseif ($language != "Any Language" && $continent != "Anywhere") {
				$sql = "SELECT DISTINCT countries.Name FROM countries, languages WHERE languages.Language = '" . $language . "' AND countries.Continent = '" . $continent . "' AND languages.CountryCode = countries.Code ORDER BY countries.Name;";
			}
			elseif($language == "Any Language" && $continent != "Anywhere") {
				$sql = "SELECT DISTINCT countries.Name FROM countries, languages WHERE countries.Continent = '" . $continent . "' AND languages.CountryCode = countries.Code ORDER BY countries.Name;";
			}
			elseif($continent == "Anywhere" && $language != "Any Language") {
				$sql = "SELECT DISTINCT countries.Name FROM countries, languages WHERE languages.Language = '" . $language . "' AND languages.CountryCode = countries.Code ORDER BY countries.Name;";
			}
			else {
				$sql = "SELECT DISTINCT countries.Name FROM countries, languages WHERE languages.CountryCode = countries.Code ORDER BY countries.Name;";
			}
			$query = $db->prepare($sql);
			$query->execute();
			$rows = $query->fetchAll();
			foreach($rows as $row){
				$choice = $row["name"];
			?>
				<ul>
				<li><?= $choice ?></li>
 				</ul>
 			<?php
			}
		}
	}
}
function print_languages() {
	$languages = $_GET["languages"];
	?>
	<ul>
	<?php
		foreach($languages as $language){
	?>
		<li><?= $language ?></li>
	<?php
		}
	?>
	</ul>
<?php
}
function print_economy() {
	$development = $_GET["development"];
	?>
		<?= $development ?>
<?php
}
?>
