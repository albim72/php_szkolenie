<html>
<head>
    <title>rejestracja</title>
    <style>
        body {
            font-family: Cambria;
            font-size: 14pt;
            color: navy;
        }
        .error {
            color:red;
        }

    </style>
</head>
<body>
<?php

$name = $email = $website = $comment = $plec = "";
$nameErr = $emailErr = $websiteErr = $plecErr = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["name"])){
        $nameErr = "imie jest wymagalne!";
    }else{
        $name = test_input($_POST["name"]);
        if(!preg_match("/^[a-zA-Z-']*$/",$name)){
            $nameErr="dopuszczalne tylko litery oraz białe znaki.";
        }
    }

    if(empty($_POST["email"])){
        $emailErr="email wymagalny!";
    }else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "zły format email";
        }
    }


    if(empty($_POST["website"])){
        $websiteErr="strona wymagalna!";
    }else{
        $website = test_input($_POST["website"]);
       if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
            $websiteErr = "zły format url";
        }
    }

    if(empty($_POST["comment"])){
        $comment="";
    }else{
        $comment = test_input($_POST["comment"]);
    }


    if(empty($_POST["plec"])){
        $plecErr="pole wymagalne!";
    }else{
        $plec = test_input($_POST["plec"]);
    }
}



function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<h2>Wypełnij formularz rejestracyjny</h2>
<p><span class="error">* pole wymagalne</span> </p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <!-- pole imie -->
    Podaj imie: <input type="text" name="name" value="<?php echo $name;?>">
    <span class="error">*<?php echo $nameErr;?></span>
    <br><br>
    <!-- pole e-mail -->
    Podaj swoj e-mail: <input type="email" name="email" value="<?php echo $email;?>">
    <span class="error">*<?php echo $emailErr;?></span>
    <br><br>
    <!-- pole strona www -->

    Podaj adres strony: <input type="url" name="website" value="<?php echo $website;?>">
    <span class="error">*<?php echo $websiteErr;?></span>
    <br><br>

    Wpisz komentarz: <textarea name="comment" rows="5" cols="40">
        <?php echo $comment;?>
    </textarea>
    <br><br>

    Wybierz plec:
    <input type="radio" name="plec" <?php if(isset($plec) && $plec == "kobieta") echo "checked";?>
    value="kobieta">KOBIETA
    <input type="radio" name="plec" <?php if(isset($plec) && $plec == "mezczyzna") echo "checked";?>
           value="mezczyzna">MEZCZYZNA
    <span class="error">*<?php echo $plecErr;?></span>
    <br><br>
    <input type="submit" name="submit" value="Rejestruj">
</form>

<?php
echo "<h2>Twoje dane rejestracyjne:</h2>";
echo "imie: ".$name;
echo "<br>";
echo "e-mail: ".$email;
echo "<br>";
echo "strona www: ".$website;
echo "<br>";
echo "komentarz: ".$comment;
echo "<br>";
echo "plec: ".$plec;
echo "<br>";

?>

</body>
</html>