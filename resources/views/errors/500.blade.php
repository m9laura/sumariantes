<!-- resources/views/errors/error-500.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error 500</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 0 auto;
            max-width: 960px;
            padding: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        p {
            font-size: 24px;
            font-family: "Times New Roman", Times, serif;
            line-height: 1.5;
            margin-bottom: 20px;
            color: gray;
        }

        .error-gif {
            /* Estilo para tu GIF */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>
            <img src="{{ asset('img/cat1.gif') }}" alt="Error GIF" class="error-gif">
        </h1>
        <p>¡LOS SIENTO! pero no tiene privilegios para realizar esta acción</p>
    </div>
</body>
</html>