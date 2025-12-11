<?php

namespace App\Gestionnaires;

use DOMDocument;

/**
 * Rend une série de proverbes.
 * Remarque : les proverbes proviennent de wikipédia (online)
 */
class GestionnaireProverbesWikipedia implements IGestionnaireProverbes
{
	// Récupère le contenu (texte) des tags li de l'url spécifiée
	// La fonction retourne un tableau de chaînes de caractères
	private function recupereTagsLi($url)
	{
		$doc = new DOMDocument();
		// On récupère le contenu html
		libxml_use_internal_errors(true);
		$doc->loadHTMLFile($url);
		libxml_use_internal_errors(false);
		// On récupère tous les éléments <li> du code html
		// car les proverbes y figurent
		$tagsLi = $doc->getElementsByTagName('li');
		// On met le contenu texte (des tags li) dans un tableau
		$tagsTexte = [];
		for ($i = 0; $i < $tagsLi->length; $i++) {
			$tagLi = $tagsLi->item($i);
			$tagsTexte[] = $tagLi->nodeValue;
		}
		return $tagsTexte;
	}

	// Le contenu texte des tags li ne contiennent pas tous des proverbes.
	// Du coup il faut "nettoyer" un peu.
	private function recupereUniquementProverbes($tagsTexte)
	{
		//dd($tagsTexte);
		$proverbes = [];
		$trouveDeclancheurEnregistrement = false;
		$pos = -1;
		$fin = false;
		// parcours de tous les tags <li> pour ne garder que les bons
		do {
			$pos++;
			$tagTexte = $tagsTexte[$pos];
			if (!$trouveDeclancheurEnregistrement) {
				if ($pos == 71) {
					$trouveDeclancheurEnregistrement = true;
					$proverbes[] = $tagTexte;
				}
			} else {
				// on s'arrête lorsqu'on a trouvé le mot Wiktionnaire
				if (str_contains($tagTexte, 'Wiktionnaire')) {
					$fin = true;
				} else {
					$proverbes[] = $tagTexte;
				}
			}
		} while (!$fin && $pos < count($tagsTexte));
		return $proverbes;
	}

	/**
	 * Récupere tous les proverbes français de wikipedia online
	 * @return type Un tableau contenant tous les proverbes
	 */
	public function rendProverbes()
	{
		$url =
			'https://fr.wiktionary.org/wiki/Annexe:Liste_de_proverbes_fran%C3%A7ais';
		$tagsLiTexte = $this->recupereTagsLi($url);
		$proverbes = $this->recupereUniquementProverbes($tagsLiTexte);
		return $proverbes;
	}

	/**
	 * Permet de savoir d'où proviennent les proverbes
	 * @return string "Source : Proverbes provenant de wikipédia"
	 */
	public function rendSource()
	{
		return 'Source : Proverbes provenant de wikipédia';
	}
}
