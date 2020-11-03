<!-- Yusa Celiker -->
<?php

include 'database.php';
include 'helperfunctions.php';
//
// $t = new database('localhost', 'root', '', 'drempeltoets', 'utf8');
// $hash = password_hash('admin', PASSWORD_DEFAULT);
// $t->create_or_update_medewerker('Nilu', '', 'Can', 'admin', $hash);
  // maak een array met alle name attributes
//
// $o = new database('localhost', 'root', '', 'drempeltoets', 'utf8');
// $o->create_or_update_medewerker('Yusa', '', 'Celiker', 'admin', password_hash('admin', PASSWORD_DEFAULT));
// // public function create_or_update_medewerker($voorletters, $voorvoegsels, $achternaam, $gebruikersnaam, $wachtwoord){


if(isset($_POST)){
  $fields = [
      "gebruikersnaam",
      "wachtwoord"
  ];
$obj = new HelperFunctions();
$no_error = $obj->has_provided_input_for_required_fields($fields);

  // in case of field values, proceed, execute insert
if($no_error){
  $gebruikersnaam = $_POST['gebruikersnaam'];
  $wachtwoord = $_POST['wachtwoord'];

  $db = new database('localhost', 'root', '', 'drempeltoets', 'utf8');
  $db->authenticate_user($gebruikersnaam, $wachtwoord);
}
}




 ?>


<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>login pagina</title>
	</head>
	<body>
		<form id='login' action='login.php' method='post' accept-charset='UTF-8'>
			<fieldset >
				<legend>Login</legend>
				<input type="text" name="gebruikersnaam" placeholder="gebruikersnaam" required/>
				<input type="password" name="wachtwoord" placeholder="wachtwoord" required/>
        <input type='submit' name="submit" value='submit' />
			</fieldset>

		  	<p>
		  		Reset Password? <a href="reset.php">Reset</a>
		  	</p>
		</form>
	</body>
</html>
