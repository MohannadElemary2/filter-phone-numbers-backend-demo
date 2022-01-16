<?php

namespace App\Filters;

use App\Filters\Base\Filter;
use App\Repositories\CustomerRepository;

class CustomerFilter extends Filter
{
    /**
     * Filter Customers By Country Code
     *
     * @param string|null $value
     * @return Builder
     * @author Mohannad Elemary
     */
    public function country(string $value = null)
    {
        return $this->builder->where('phone', 'like', "($value)%");
    }

    /**
     * Filter Customers By Phone Valid State
     *
     * @param string|null $value
     * @return Builder
     * @author Mohannad Elemary
     */
    public function valid(string $value = null)
    {
        $patterns = '';

        // Prepare regex pattern
        foreach (config("countries.country_regex") as $regex) {
            $regex = substr($regex, 1);
            $regex = substr($regex, 0, -1);

            $patterns .= "($regex)" . '|';
        }

        $patterns = rtrim($patterns, "|");

        // Filter Based on whethere the valid or not valid is needed
        if ($value) {
            return $this->filterValidStates($patterns);
        } else {
            return $this->filterInvalidStates($patterns);
        }
    }

    /**
     * Get Customers With Valid Phones
     *
     * @param string $patterns
     * @return Builder
     * @author Mohannad Elemary
     */
    private function filterValidStates($patterns)
    {
        return $this->builder->where("phone", "REGEXP", $patterns);
    }

    /**
     * Get Customers With Non-valid Phones
     *
     * @param string $patterns
     * @return Builder
     * @author Mohannad Elemary
     */
    private function filterInvalidStates($patterns)
    {
        $invalidIDs = app(CustomerRepository::class)
            ->whereRegex("phone", $patterns)
            ->pluck('id')
            ->toArray();

        return $this->builder->whereNotIn("id", $invalidIDs);
    }
}
