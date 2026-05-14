<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $_SESSION["players"] = [
        [
            "ime" => $_POST["ime1"],
            "priimek" => $_POST["priimek1"],
            "naslov" => $_POST["naslov1"]
        ],
        [
            "ime" => $_POST["ime2"],
            "priimek" => $_POST["priimek2"],
            "naslov" => $_POST["naslov2"]
        ],
        [
            "ime" => $_POST["ime3"],
            "priimek" => $_POST["priimek3"],
            "naslov" => $_POST["naslov3"]
        ]
    ];
}

if(!isset($_SESSION["players"])){
    header("Location: index.php");
    exit();
}

$players = $_SESSION["players"];
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Igra kock</title>
	<link rel="stylesheet" href="css/Style2.css">
</head>
<body>

<h1>Simulacija metanja kock</h1>

<button id="gumb" onclick="vrzi()">VRZI KOCKE</button>

<div id="rezultat"></div>


</body>
<script>
    const players = <?php echo json_encode($players); ?>;
</script>
<script src="js/script.js"></script>
</html>
