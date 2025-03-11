<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ManifRuleV10 implements ValidationRule
{
	protected $debut;

	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct($debut)
	{
		//dd("yes !");
		$this->debut = $debut;
	}

	/**
	 * Run the validation rule.
	 *
	 * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
	 */
	public function validate(string $attribute, mixed $value, Closure $fail): void
	{
		$value = date('Y-m-d', strtotime($value));
		$dateAuMinimum = date('Y-m-d', strtotime($this->debut . ' + 3 days'));
		$dateAuMaximum = date('Y-m-d', strtotime($this->debut . ' + 5 days'));
		if (!($value >= $dateAuMinimum && $value <= $dateAuMaximum)) {
			$fail(__('validation2.wrongperiod')); // https://laravel.com/docs/10.x/localization
		}
	}
}
