<?php
// Open-Meteo endpoint voor Amsterdam
$url = "https://api.open-meteo.com/v1/forecast?latitude=52.37&longitude=4.89&current_weather=true";

$error = null;
$data = null;

// GET-request uitvoeren
$response = @file_get_contents($url);

if ($response === false) {
    $error = "Kan geen verbinding maken met de Open-Meteo API.";
} else {
    $data = json_decode($response, true);

    if (!isset($data['current_weather'])) {
        $error = "Ongeldige data ontvangen van de API.";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Weer in Amsterdam</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background: #fff;
            padding: 24px 32px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
            min-width: 280px;
        }

        h1 {
            margin-top: 0;
        }

        .temp {
            font-size: 48px;
            font-weight: bold;
            margin: 10px 0;
        }

        .wind {
            font-size: 18px;
            color: #555;
        }

        .error {
            color: #c0392b;
            font-weight: bold;
        }

        .loading {
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>🌤️ Amsterdam</h1>

    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>

    <?php elseif ($data === null): ?>
        <p class="loading">Weergegevens laden…</p>

    <?php else: ?>
        <div class="temp">
            <?= $data['current_weather']['temperature'] ?>°C
        </div>
        <div class="wind">
            💨 Wind: <?= $data['current_weather']['windspeed'] ?> km/u
        </div>
    <?php endif; ?>
</div>

</body>
</html>
