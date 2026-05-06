<?php
session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $players = [];

    for ($i = 1; $i <= 3; $i++) {
        $ime = trim($_POST["ime$i"] ?? '');
        $priimek = trim($_POST["priimek$i"] ?? '');
        $naslov = trim($_POST["naslov$i"] ?? '');

        if ($ime === '' || $priimek === '' || $naslov === '') {
            $errors[] = "Izpolnite vse podatke za igralca $i.";
        }

        $players[] = [
            'ime' => htmlspecialchars($ime, ENT_QUOTES, 'UTF-8'),
            'priimek' => htmlspecialchars($priimek, ENT_QUOTES, 'UTF-8'),
            'naslov' => htmlspecialchars($naslov, ENT_QUOTES, 'UTF-8')
        ];
    }

    if (empty($errors)) {
        $_SESSION['players'] = $players;
        header('Location: index2.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vnos igralcev</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #171717, #3f3f46);
            color: #fff;
        }
        .box {
            width: 920px;
            max-width: 94%;
            background: rgba(255,255,255,0.1);
            padding: 28px;
            border-radius: 18px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.35);
        }
        h1 { text-align: center; margin-top: 0; }
        .players {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }
        .player {
            background: rgba(255,255,255,0.12);
            padding: 18px;
            border-radius: 14px;
        }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input {
            width: 100%;
            margin-top: 6px;
            padding: 11px;
            border: none;
            border-radius: 10px;
            font-size: 15px;
        }
        button {
            width: 100%;
            margin-top: 24px;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            background: #22c55e;
            color: white;
        }
        button:hover { background: #16a34a; }
        .error {
            background: #dc2626;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        @media (max-width: 780px) {
            .players { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>🎲 Vnos 3 igralcev</h1>

        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <div><?= $error ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php">
            <div class="players">
                <?php for ($i = 1; $i <= 3; $i++): ?>
                    <div class="player">
                        <h2>Igralec <?= $i ?></h2>
                        <label>Ime</label>
                        <input type="text" name="ime<?= $i ?>" required>

                        <label>Priimek</label>
                        <input type="text" name="priimek<?= $i ?>" required>

                        <label>Naslov</label>
                        <input type="text" name="naslov<?= $i ?>" required>
                    </div>
                <?php endfor; ?>
            </div>
            <button type="submit">Začni igro</button>
        </form>
    </div>
</body>
</html>
