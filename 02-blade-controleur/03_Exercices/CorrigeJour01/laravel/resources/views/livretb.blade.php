<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Livret {{$n}}</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
  <?php
	for ($mult = 1; $mult <= 12; $mult++) {
		echo $mult . ' * ' . $n . ' = ' . $mult * $n, '<br>';
	}
  ?>
</body>
</html>