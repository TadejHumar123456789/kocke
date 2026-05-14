<?php
session_start();
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Prijava igralcev</title>
	<link rel="stylesheet" href="css/Style1.css">
</head>
<body>

<div class="box">
    <h1>Vnos igralcev</h1>

    <form action="index2.php" method="POST">

        <div class="igralec">
            <h2>Igralec 1</h2>
            <input type="text" name="ime1" placeholder="Ime" required>
            <input type="text" name="priimek1" placeholder="Priimek" required>
            <input type="text" name="naslov1" placeholder="Naslov" required>
        </div>

        <div class="igralec">
            <h2>Igralec 2</h2>
            <input type="text" name="ime2" placeholder="Ime" required>
            <input type="text" name="priimek2" placeholder="Priimek" required>
            <input type="text" name="naslov2" placeholder="Naslov" required>
        </div>

        <div class="igralec">
            <h2>Igralec 3</h2>
            <input type="text" name="ime3" placeholder="Ime" required>
            <input type="text" name="priimek3" placeholder="Priimek" required>
            <input type="text" name="naslov3" placeholder="Naslov" required>
        </div>

        <div class="submit-box">
            <input type="submit" value="Začni igro">
        </div>

    </form>
</div>

</body>
</html>
