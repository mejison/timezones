<h5><a href="/presenters.php" class="featuredlink">Featured Presenters</a></h5>

<?php 

if (!$numberphotos) {

	$numberphotos = 3;

}

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	mysqli_query($conn,"SET CHARACTER SET 'utf8'");
	
	$sql = "SELECT PresentersName, PhotoNameKey, ShowPresenterLink, Country, State, City FROM $table1 ORDER BY PresentersName";

	$result = $conn->query($sql);

	

	
	if ($result->num_rows > 1) {
		
		$i = 1;		
		// output data of each row
		while($row = $result->fetch_assoc()) {
			
			$presentersname = $row["PresentersName"];
			$PhotoNameKey = $row["PhotoNameKey"];
			$country = $row["Country"];
			$city = $row["City"];
			$state = $row["State"];

			if (($city) && ($state))  {
				$citystate = $city . ", " . $state . "<br>";
			} elseif (($city) && !($state)) {
				$citystate = $city . "<br>";
			} elseif (!($city) && ($state)) {
				$citystate = $state . "<br>";
			} else {
				$citystate = "";
			}
						
			if ($row["ShowPresenterLink"] !="False") {
								
				$showpic[$i] = "<a href=\"presenter.php?presenter=" . $PhotoNameKey . "\" class=\"featuredlink\"><img src=\"/presenterphotos/photo-". $PhotoNameKey . ".jpg\" class=\"featurephoto\" id=\"featurephotoid\" alt=\"" . $presentersname . "\" /><h6 class=\"photosidebarh6\">" . $presentersname . "<br><span class=\"countrycolor\">" . $citystate . $country . "</span></h6></a>";
				$i++;
			}			
		}
		
	} else {
		// leave blank
	}


$count = count($showpic);

$numbers = range(1, $count);
shuffle($numbers);

$i = 1;

while ($i <= $numberphotos) {
	echo $showpic[$numbers[$i]];
	$i++;
}

?>


<h6 class="photosidebarh6"><a href="/presenters.php">See More Presenters!</a></h6>