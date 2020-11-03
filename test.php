<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Register - Vatsal Technosoft Messenger</title>

    <link href="Style/regstyle.css" rel="stylesheet" type="text/css" />
 </head>
 <body>
    <?php include 'database.php'; ?>
    <?php include 'helperfunctions.php'; ?>

    <div id="outer">
        <div id="companyname"></div>

        <div class="container">
            <div id="formcontainer">
                <h3>Registration Form </h3>
                <form name="register_form" action="" method="post">
<?php
if( isset($_POST['voorletters']) AND
    isset($_POST['voorvoegsels']) AND
    isset($_POST['Achternaam']) AND
    isset($_POST['Gebruikersnaam']) AND
    isset($_POST['Wachtwoord'])) {

        $voorletters = $_POST['voorletters'];
        $voorvoegsels = $_POST['voorvoegsels'];
        $Achternaam = $_POST['Achternaam'];
        $Gebruikersnaam = $_POST['Gebruikersnaam'];
        $Wachtwoord = $_POST['Wachtwoord'];


    if( empty($voorletters) or
        empty($voorvoegsels) or
        empty($Achternaam) or
        empty($Gebruikersnaam) or
        empty($Wachtwoord)) {

          $message = "All Information Is neccessary";

    } else {

        $sql = mysql_query("INSERT INTO users (voorletters , voorvoegsels , Achternaam, Gebruikersnaam, Wachtwoord) VALUES ()");

        if($sql) {
            $message = "OK....!";
        } else {
            $message = "BAD";
        }
    }
        echo  "<div class='box'> $message </div>";
    }
?>


                    <div id="formtext">
                        Gebruikersnaam :     <input type="text" name="Gebruikersnaam" style="width:200px;" autocomplete="off"/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Wachtwoord  :     <input type="password" name="Wachtwoord" autocomplete="off" style="width:200px;"/>
                        <br /><br />

                        voorletters :    <input type="text" name="voorletters"  style="width:200px;" autocomplete="off" />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        voorvoegsels  :    <input type="text" name="voorvoegsels" autocomplete = "off" style = " width:200px; "/>
                        Achternaam  :    <input type="text" name="Achternaam" autocomplete = "off" style = " width:200px; "/>
                        <br /><br />

                        <input type="button" name="back" value="Back" style="width:100px; margin-left:95px;"/>
                        <input type="reset" name="reset" value="Reset" style="width:100px; margin-left:45px;"/>
                        <input type="submit" name="register" value="Register" style="width:100px; margin-left:45px;"/>
                    </div>
                </form>

            </div>
        </div>
    </div>
 </body>
</html>
