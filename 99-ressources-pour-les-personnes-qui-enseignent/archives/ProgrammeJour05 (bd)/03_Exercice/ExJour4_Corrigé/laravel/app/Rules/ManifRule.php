<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ManifRule implements Rule
{
	protected $debut;

	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct($debut)
	{
		$this->debut = $debut;
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string  $attribute
	 * @param  mixed  $value
	 * @return bool
	 */
	public function passes($attribute, $value)
	{
		$value = date('Y-m-d', strtotime($value));
		$dateAuMinimum = date('Y-m-d', strtotime($this->debut . ' + 3 days'));
		$dateAuMaximum = date('Y-m-d', strtotime($this->debut . ' + 5 days'));
		return $value >= $dateAuMinimum && $value <= $dateAuMaximum;
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{
		// va chercher le message correspondant à `wongperiod`
		// dans le fichier \lang\en\validation2.php
		// ou              \lang\fr\validation2.php
		// en fonction de la langue configurée dans \config\app.php
		return __('validation2.wrongperiod'); // https://laravel.com/docs/09.x/localization
	}
}
