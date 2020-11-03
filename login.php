<!-- Yusa Celiker -->
<?php

include 'database.php';
include 'helperfunctions.php';

  // maak een array met alle name attributes
  $fields = [
    	"Gebruikersnaam",
      "Wachtwoord"
  ];

$obj = new HelperFunctions();
$no_error = $obj->has_provided_input_for_required_fields($fields);

  // in case of field values, proceed, execute insert
if($no_error){
  $Gebruikersnaam = $_POST['Gebruikersnaam'];
  $Wachtwoord = $_POST['Wachtwoord'];

  $db = new database('localhost', 'root', '', 'drempel', 'utf8');
  $db->authenticate_user($Gebruikersnaam, $Wachtwoord);
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
				<input type="text" name="Gebruikersnaam" placeholder="Gebruikersnaam" required/>
				<input type="password" name="Wachtwoord" placeholder="Wachtwoord" required/>
        <input type='submit' name="submit" value='submit' />
			</fieldset>

		  	<p>
		  		Reset Password? <a href="reset.php">Reset</a>
		  	</p>
		</form>
	</body>
</html>
