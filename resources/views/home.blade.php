<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Hopital</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #fbfdff;
            color: #1f2937;
        }

        .container {
            max-width: 800px;
            margin: 80px auto;
            padding: 40px;
            background: #070707;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        h1 {
            color: #fafafa;
            margin-bottom: 15px;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
           color: #ffffff;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background: #0f766e;
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
        }

        a:hover {
            background: #115e59;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue dans l'application de l'hopital</h1>
        <p>
            Cette petite application Laravel permet d'enregistrer les patients
            et de gerer leurs informations de base.
        </p>

        <a href="{{ route('patients.index') }}">Aller a l'enregistrement des patients</a>
    </div>
</body>
</html>
