<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Email Template</title>
    <style type="text/css">
        /* Reset some default styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #fafafa;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,.1);
            background-color: white;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        p {
            line-height: 1.6em;
            color: #777;
        }

        a {
            display: block;
            width: 100%;
            padding: 15px;
            margin-top: 20px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        @media only screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }

            button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h3>Восстановление пароля</h3>

    <p>Привет, {{ $user->firstname }}</p>
    <p>Чтобы восстановить пароль пройдте по ссылке: </p>
    <a href="{{ $actionLink }}" target="_blank">ВОССТАНОВИТЬ ПАРОЛЬ</a>
    <p>Внимание! Данная ссылка действительна в течении 15 минут.</p>
    <p>Если вы не отправляли этот запрос, пожалуйста, проигнорируйте это сообщение.</p>
</div>
</body>
</html>
