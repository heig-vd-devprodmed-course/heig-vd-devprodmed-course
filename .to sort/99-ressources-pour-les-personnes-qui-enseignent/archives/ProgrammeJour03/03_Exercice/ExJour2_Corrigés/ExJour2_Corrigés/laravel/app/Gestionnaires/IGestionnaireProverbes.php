<?php

namespace App\Gestionnaires;

/**
 * Tous les gestionnaires de proverbes doivent :
 *      - Rendre des proverbes
 *      - Indiquer d'où proviennent ces proverbes
 */
interface IGestionnaireProverbes
{
	/**
	 * Doit rendre un tableau de proverbes
	 */
	public function rendProverbes();

	/**
	 * Doit indiquer d'où proviennent les proverbes (chaîne de caractère)
	 */
	public function rendSource();
}
