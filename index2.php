<?php
session_start();

if (!isset($_SESSION['players']) || count($_SESSION['players']) !== 3) {
    header('Location: index.php');
    exit;
}

$players = $_SESSION['players'];
$gamePlayed = false;
$winners = [];
$maxSum = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vrzi'])) {
    $gamePlayed = true;

    foreach ($players as $key => $player) {
        $dice = [rand(1, 6), rand(1, 6), rand(1, 6)];
        $sum = array_sum($dice);

        $players[$key]['dice'] = $dice;
        $players[$key]['sum'] = $sum;

        if ($sum > $maxSum) {
            $maxSum = $sum;
            $winners = [$players[$key]];
        } elseif ($sum === $maxSum) {
            $winners[] = $players[$key];
        }
    }

    $_SESSION['last_game'] = $players;
}
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Igra s kockami</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            background: radial-gradient(circle at top, #52525b, #18181b 65%);
            color: white;
            padding: 30px;
        }
        h1, .center { text-align: center; }
        .board {
            max-width: 1100px;
            margin: 0 auto;
        }
        .players {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 25px;
        }
        .card {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 20px 45px rgba(0,0,0,0.3);
        }
        .card h2 { margin-top: 0; }
        .dice-row {
            display: flex;
            justify-content: center;
            gap: 14px;
            margin: 20px 0;
            min-height: 70px;
        }
        .dice-row img {
            width: 64px;
            height: 64px;
            border-radius: 9px;
        }
        .sum {
            font-size: 22px;
            font-weight: bold;
            text-align: center;
        }
        .btn {
            border: none;
            border-radius: 14px;
            padding: 15px 40px;
            font-size: 20px;
            font-weight: bold;
            color: white;
            background: #ef4444;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(239,68,68,0.35);
        }
        .btn:hover { background: #dc2626; }
        .winner {
            max-width: 700px;
            margin: 30px auto 0;
            padding: 22px;
            border-radius: 18px;
            background: rgba(34,197,94,0.18);
            border: 1px solid rgba(34,197,94,0.45);
            text-align: center;
            font-size: 20px;
        }
        .info {
            text-align: center;
            opacity: 0.85;
            margin-top: 14px;
        }
        @media (max-width: 850px) {
            .players { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="board">
        <h1>🎲 Simulacija igranja z igralnimi kockami</h1>

        <?php if (!$gamePlayed): ?>
            <div class="center">
                <form method="post" action="index2.php" onsubmit="startAnimation()">
                    <button class="btn" type="submit" name="vrzi">Vrzi kocke</button>
                </form>
            </div>
        <?php endif; ?>

        <div class="players">
            <?php foreach ($players as $player): ?>
                <div class="card">
                    <h2><?= $player['ime'] . ' ' . $player['priimek'] ?></h2>
                    <p><strong>Naslov:</strong> <?= $player['naslov'] ?></p>

                    <div class="dice-row">
                        <?php if ($gamePlayed): ?>
                            <?php foreach ($player['dice'] as $die): ?>
                                <img class="final-dice" src="dice<?= $die ?>.gif" alt="Kocka <?= $die ?>">
                            <?php endforeach; ?>
                        <?php else: ?>
                            <img class="anim-dice" src="dice-anim.gif" alt="Animacija kocke">
                            <img class="anim-dice" src="dice-anim.gif" alt="Animacija kocke">
                            <img class="anim-dice" src="dice-anim.gif" alt="Animacija kocke">
                        <?php endif; ?>
                    </div>

                    <?php if ($gamePlayed): ?>
                        <div class="sum">Seštevek: <?= $player['sum'] ?></div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($gamePlayed): ?>
            <div class="winner">
                <strong>Zmagovalec/i:</strong><br>
                <?php foreach ($winners as $winner): ?>
                    <?= $winner['ime'] . ' ' . $winner['priimek'] ?>, seštevek: <?= $winner['sum'] ?><br>
                <?php endforeach; ?>
            </div>
            <div class="info">Rezultat bo prikazan 10 sekund, nato se stran preusmeri nazaj na obrazec.</div>

            <script>
                setTimeout(function () {
                    window.location.href = 'index.php';
                }, 10000);
            </script>
        <?php endif; ?>
    </div>

    <script>
        function startAnimation() {
            document.querySelectorAll('.dice-row img').forEach(function (img) {
                img.src = 'dice-anim.gif';
            });
        }
    </script>
</body>
</html>
