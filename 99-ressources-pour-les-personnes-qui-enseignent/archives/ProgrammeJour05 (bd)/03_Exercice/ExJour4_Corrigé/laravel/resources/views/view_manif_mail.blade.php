<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
	</head>
	<body>
		<h2>Manifestation</h2>
		<p>
			La prochaine manifestation aura lieu du
			{{ date('d.m.Y', strtotime($debut)) }} au
			{{ date('d.m.Y', strtotime($fin)) }} à {{ $lieu }}.
		</p>
		<p>Avec nos meilleures salutations.</p>
		<p>Le comité</p>
	</body>
</html>
