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

    <style>
        body{
            font-family:Arial, sans-serif;
            background:#222;
            color:white;
            text-align:center;
        }

        .players-wrap{
            display:flex;
            justify-content:center;
            gap:20px;
            flex-wrap:wrap;
            margin-top:25px;
        }

        .player{
            background:#333;
            width:300px;
            padding:20px;
            border-radius:10px;
        }

        img{
            width:80px;
            margin:5px;
        }

        button{
            padding:15px 30px;
            font-size:20px;
            background:green;
            color:white;
            border:none;
            border-radius:10px;
            cursor:pointer;
        }

        button:disabled{
            background:gray;
            cursor:not-allowed;
        }

        .winner{
            margin-top:25px;
            color:#7CFF7C;
        }
    </style>
</head>
<body>

<h1>Simulacija metanja kock</h1>

<button id="gumb" onclick="vrzi()">VRZI KOCKE</button>

<div id="rezultat"></div>

<script>
let players = <?php echo json_encode($players); ?>;

function vrzi(){
    document.getElementById("gumb").disabled = true;

    let meti = [];
    let max = 0;
    let winners = [];

    for(let i = 0; i < players.length; i++){
        let s1 = Math.floor(Math.random() * 6) + 1;
        let s2 = Math.floor(Math.random() * 6) + 1;
        let s3 = Math.floor(Math.random() * 6) + 1;
        let sum = s1 + s2 + s3;

        meti.push({
            kocke: [s1, s2, s3],
            vsota: sum
        });

        if(sum > max){
            max = sum;
            winners = [players[i].ime + " " + players[i].priimek];
        }else if(sum == max){
            winners.push(players[i].ime + " " + players[i].priimek);
        }
    }

    let html = '<div class="players-wrap">';

    for(let i = 0; i < players.length; i++){
        html += `
            <div class="player">
                <h2>${players[i].ime} ${players[i].priimek}</h2>
                <p><b>Naslov:</b> ${players[i].naslov}</p>

                <div id="dice${i}">
                    <img src="images/dice-anim.gif">
                    <img src="images/dice-anim.gif">
                    <img src="images/dice-anim.gif">
                </div>

                <h3 id="vsota${i}"></h3>
            </div>
        `;
    }

    html += '</div>';

    document.getElementById("rezultat").innerHTML = html;

    setTimeout(() => {
        for(let i = 0; i < players.length; i++){
            document.getElementById("dice" + i).innerHTML = `
                <img src="images/dice${meti[i].kocke[0]}.gif">
                <img src="images/dice${meti[i].kocke[1]}.gif">
                <img src="images/dice${meti[i].kocke[2]}.gif">
            `;

            document.getElementById("vsota" + i).innerHTML = "Vsota: " + meti[i].vsota;
        }

        document.getElementById("rezultat").innerHTML += `
            <h1 class="winner">Zmagovalec/i: ${winners.join(", ")}</h1>
        `;
    }, 2000);

    setTimeout(() => {
        window.location.href = "index.php";
    }, 10000);
}
</script>

</body>
</html>
