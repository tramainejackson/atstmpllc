<?php 
echo (rand(0,3));
echo "</br>";
$test = "account_savings";
$posTest = substr_count($test, "user") > 0 ? str_ireplace("user_", "", $test) : str_ireplace("account_", "", $test);
echo substr_count($test, "user");
echo "<br/>";
echo "Test = " . $posTest;
echo "<br/>";
echo round(999.894, 2);
echo "<br/>";

$array =	(object) array(
				"first" => "1",
				"last" => "2",
				"third" => "3",
				"fourth" => "4",
				"fifth" => "5"
			);

foreach($array as $key => $value) {
	echo $key . " = " . $value;
	print_r($array);
	echo "<br/>";
}

echo "<hr/>";

$object_vars = get_object_vars($array);
print_r($object_vars);

echo password_hash("1234567", PASSWORD_BCRYPT);
?>