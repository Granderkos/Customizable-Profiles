<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/gameSelect.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <button type="submit" id="back" onclick="back()">
        <i class="fas fa-arrow-left"></i>
    </button>
    <title>Document</title>
</head>
<body>
  <!-- "GUI" game selection style only -->
</div>
  <div class="squares">
    <div class="square1" onclick="changeGame('aimtrainer')">
      <div class="square-header">
        Aim Trainer
      </div>
    </div>
    <div class="square2">
      <div class="square-header">
        GAME 2
      </div>
    </div>
    <div class="square3">
      <div class="square-header">
        GAME 3
      </div>
    </div>
    <div class="square-before">
      <div class="square-header">
      </div>
    </div>
    <div class="square-after">
      <div class="square-header">
      </div>
    </div>
  </div>
  <!-- "animation" -->
  <script src="../js/changeGame.js"></script>
  <!-- back arrow -->
  <script src="../js/back.js"></script>
</body>
</html>