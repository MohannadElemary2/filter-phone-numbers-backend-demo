<?php

namespace App\Models;

use App\Filters\Base\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, Filterable;

    protected $table = 'customer';

    protected $appends = [
        'country_code',
        'country',
        'phone_number',
        'is_valid',
    ];

    /**
     * Get Customer's Country Code From His Phone
     *
     * @return string
     * @author Mohannad Elemary
     */
    public function getCountryCodeAttribute()
    {
        $string = ' ' . $this->phone;

        $ini = strpos($string, '(');

        if ($ini == 0) return "";

        $ini += strlen('(');
        $len = strpos($string, ')', $ini) - $ini;

        return substr($string, $ini, $len);
    }

    /**
     * Get Customer's Country Based On The Country Code From His Phone
     *
     * @return string
     * @author Mohannad Elemary
     */
    public function getCountryAttribute()
    {
        return config("countries.country_names.{$this->country_code}") ?? null;
    }

    /**
     * Get Customer's Phone Number Without The Country Code
     *
     * @return string
     * @author Mohannad Elemary
     */
    public function getPhoneNumberAttribute()
    {
        if (!$this->country_code) {
            return null;
        }

        return trim(str_replace("({$this->country_code})", '', $this->phone));
    }

    /**
     * Get Whether The Phone Is Valid Or Not By Applying Regex Of Its Country
     *
     * @return bool
     * @author Mohannad Elemary
     */
    public function getIsValidAttribute()
    {
        return (bool) preg_match(
            config("countries.country_regex.{$this->country_code}"),
            $this->phone
        );
    }
}
