<?php

namespace App\Gestionnaires;

/**
 * Rend une série de proverbes.
 * Remarque : les proverbes sont hardcodés
 */
class GestionnaireProverbesHardcode implements IGestionnaireProverbes
{
	/**
	 * Rend une série de proverbes.
	 * @return type Un tableau contenant tous les proverbes
	 */
	public function rendProverbes()
	{
		$proverbes = [
			'à bon entendeur salut',
			'beaucoup de bruit pour rien',
			'ce qui doit être sera',
			'diseur de bons mots, mauvais caractère',
			'eau trouble ne fait pas miroir',
			'fagot bien lié est à moitié porté',
			'gober des mouches',
			'herbe connue soit bienvenue',
			'il faut se méfier de l’eau qui dort',
			'jamais deux sans trois',
			'l’amour est aveugle',
			'mieux vaut être seul que mal accompagné',
			'ni vu ni connu',
			'œil pour œil, dent pour dent',
			'Paris ne s’est pas fait en un jour',
			'quand le chat n’est pas là, les souris dansent',
			'rien ne sert de courir, il faut partir à temps',
			'si jeunesse savait, si vieillesse pouvait',
			'tomber pour mieux se relever',
		];
		return $proverbes;
	}

	/**
	 * Permet de savoir d'où proviennent les proverbes
	 * @return string "Source : Proverbes hardcodés"
	 */
	public function rendSource()
	{
		return 'Source : Proverbes hardcodés';
	}
}
