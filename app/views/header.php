<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title>
</head>

<body>

    <head>
        <li>
            <?php if ($logged_in === false): ?>
            <ul>
                <a href="/index.php/sign-up">sign-up</a>
            </ul>
            <ul>
                <a href="/index.php/sign-in">sign-in</a>
            </ul>
            <?php else: ?>
            <ul>
                <a href="/index.php/user">user</a>
            </ul>
            <ul>
                <a href="/index.php/change-password">change-password</a>
            </ul>
            <ul>
                <a href="/index.php/sign-out">sign-out</a>
            </ul>
            <?php endif; ?>
        </li>
    </head>