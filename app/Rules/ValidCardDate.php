<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCardDate implements ValidationRule
{
    private $year;
    private $month;

    public function __construct($year, $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $this->month = str_pad($this->month, 2, '0', STR_PAD_LEFT);

        if (strlen($this->year) == 2) {
            $this->year = '20' . $this->year;
        }

        if (!preg_match('/^20\d\d$/', $this->year)) {
            $fail(':attribute kontrol ediniz');
        }

        if (!preg_match('/^(0[1-9]|1[0-2])$/', $this->month)) {
            $fail(':attribute kontrol ediniz');
        }

        // past date
        if ($this->year < date('Y') || $this->year == date('Y') && $this->month < date('m')) {
            $fail(':attribute kontrol ediniz');
        }
    }
}
