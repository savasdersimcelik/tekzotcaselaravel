<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCardCvv implements ValidationRule
{
    protected static $cards = array(
        'visaelectron' => array(
            'type' => 'visaelectron',
            'pattern' => '/^4(026|17500|405|508|844|91[37])/',
            'length' => array(16),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
        'maestro' => array(
            'type' => 'maestro',
            'pattern' => '/^(5(018|0[23]|[68])|6(39|7))/',
            'length' => array(12, 13, 14, 15, 16, 17, 18, 19),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
        'forbrugsforeningen' => array(
            'type' => 'forbrugsforeningen',
            'pattern' => '/^600/',
            'length' => array(16),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
        'dankort' => array(
            'type' => 'dankort',
            'pattern' => '/^5019/',
            'length' => array(16),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
        'visa' => array(
            'type' => 'visa',
            'pattern' => '/^4/',
            'length' => array(13, 16),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
        'mastercard' => array(
            'type' => 'mastercard',
            'pattern' => '/^(5[0-5]|2[2-7])/',
            'length' => array(16),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
        'amex' => array(
            'type' => 'amex',
            'pattern' => '/^3[47]/',
            'format' => '/(\d{1,4})(\d{1,6})?(\d{1,5})?/',
            'length' => array(15),
            'cvcLength' => array(3, 4),
            'luhn' => true,
        ),
        'dinersclub' => array(
            'type' => 'dinersclub',
            'pattern' => '/^3[0689]/',
            'length' => array(14),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
        'discover' => array(
            'type' => 'discover',
            'pattern' => '/^6([045]|22)/',
            'length' => array(16),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
        'unionpay' => array(
            'type' => 'unionpay',
            'pattern' => '/^(62|88)/',
            'length' => array(16, 17, 18, 19),
            'cvcLength' => array(3),
            'luhn' => false,
        ),
        'jcb' => array(
            'type' => 'jcb',
            'pattern' => '/^35/',
            'length' => array(16),
            'cvcLength' => array(3),
            'luhn' => true,
        ),
    );


    private $number;

    public function __construct($number)
    {
        $this->number = $number;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $type = self::creditCardType($this->number);

        if (!ctype_digit($value)){
            $fail(':attribute kontrol ediniz');
        }

        if (!array_key_exists($type, self::$cards)){
            $fail(':attribute kontrol ediniz');
        }

        if (!self::validCvcLength($value, $type)){
            $fail(':attribute kontrol ediniz');
        }
    }

    protected static function validCvcLength($cvc, $type)
    {
        foreach (self::$cards[$type]['cvcLength'] as $length) {
            if (strlen($cvc) == $length) {
                return true;
            }
        }

        return false;
    }

    protected static function creditCardType($number)
    {
        foreach (self::$cards as $type => $card) {
            if (preg_match($card['pattern'], $number)) {
                return $type;
            }
        }

        return '';
    }
}
