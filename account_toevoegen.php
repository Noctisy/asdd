<!-- Yusa Celiker -->
<?php

include 'database.php';
include 'helperfunctions.php';

if(isset($_POST['submit'])){

  // maak een array met alle name attributes
  $fields = [
    	"voorletters",
      "voorvoegsels",
      "Achternaam",
      "Gebruikersnaam",
      "Wachtwoord"
  ];

$obj = new HelperFunctions();
$no_error = $obj->has_provided_input_for_required_fields($fields);

  // in case of field values, proceed, execute insert
  if($no_error){
    $voorletters = $_POST['voorletters'];
    $voorvoegsels = $_POST['voorvoegsels'];
    $Achternaam = $_POST['Achternaam'];
    $Gebruikersnaam = $_POST['Gebruikersnaam'];
    $Wachtwoord =$_POST['Wachtwoord'];

    $db = new database('localhost', 'root', '', 'drempel', 'utf8');
    $db->create_or_update_medewerker($voorletters, $voorvoegsels, $Achternaam, $Gebruikersnaam, $Wachtwoord);
    }
}
?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Registratie scherm</title>
  </head>

  <body>
  	<form method="post" action='account_toevoegen.php' method='post' accept-charset='UTF-8'>
      <fieldset >
        <legend>Registratie</legend>
        <input type="text" name="voorletters" placeholder="voorletters" required/>
        <input type="text" name="voorvoegsels" placeholder="voorvoegsels"/>
      	<input type="text" name="Achternaam" placeholder="Achternaam"  required/>
      	<input type="text" name="Gebruikersnaam" placeholder="Gebruikersnaam" required/><br/>
        <input type="password" name="Wachtwoord" placeholder="Wachtwoord" required/>
        <!-- <input type="password" name="repeatpwd" placeholder="Herhaal wachtwoord" required/> -->
        <input type="submit" name='submit' value"Sign up!"/>
      </fieldset>
      <a href="login.php">Ik heb al een account. Login!</a>
    </form>
  </body>
</html>
