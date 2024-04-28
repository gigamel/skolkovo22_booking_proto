<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Page Throwable</title>
        <meta charset="UTF-8"/>
        <style>
            body {
                font-family: sans-serif;
            }
            h1 {
                background-color: #4fb9cb;
                font-size: 32px;
                color: #ffffff;
                padding: 15px;
            }
            .error {
                max-width: 800px;
                margin: 0 auto;
                padding: 15px;
            }
            p {
                color: #030303;
                font-size: 20px;
            }
        </style>
    </head>
    <body>
        <div class="error">
            <h1>Oops!</h1>
            <p>
                <strong>Type:</strong>
                <?= get_class($e); ?>
            </p>
            <p>
                <strong>File:</strong>
                <?= sprintf('%s:%d', $e->getFile(), $e->getLine()); ?>
            </p>
            <p>
                <strong>Message:</strong>
                <?= $e->getMessage(); ?>
            </p>
            <pre><?php var_dump($e->getTrace()); ?></pre>
        </div>
    </body>
</html>
