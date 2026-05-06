<?php
session_start();
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Prijava igralcev</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f2f2f2;
            text-align:center;
        }

        .box{
            width:90%;
            max-width:1100px;
            margin:40px auto;
            background:white;
            padding:25px;
            border-radius:10px;
        }

        form{
            display:flex;
            gap:20px;
            justify-content:center;
            align-items:flex-start;
            flex-wrap:wrap;
        }

        .igralec{
            background:#eeeeee;
            padding:15px;
            border-radius:10px;
            width:300px;
        }

        input{
            width:90%;
            padding:10px;
            margin:6px 0;
        }

        h2{
            background:#333;
            color:white;
            padding:10px;
            margin-top:0;
        }

        .submit-box{
            width:100%;
            margin-top:20px;
        }

        input[type=submit]{
            width:250px;
            background:green;
            color:white;
            border:none;
            cursor:pointer;
            font-size:18px;
            border-radius:8px;
        }
    </style>
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
