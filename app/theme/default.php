<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Default Theme</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="/assets/main.css"/>
  </head>
  <body>
    <div class="app">
      <div class="header">
        <a href="/" class="logo">Skolkovo22Booking</a>
        <span class="slogan">Возьми в аренду!</span>
      </div>
      <div class="content">
        <?= $this->getContent(); ?>
      </div>
    </div>
  </body>
</html>
