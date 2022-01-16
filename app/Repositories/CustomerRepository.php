<?php

namespace App\Repositories;

use App\Filters\CustomerFilter;
use App\Models\Customer;
use App\Repositories\Base\BaseRepository;

class CustomerRepository extends BaseRepository
{
    public function model()
    {
        return Customer::class;
    }

    /**
     * Get List Of Paginated Customers And Apply Filters
     *
     * @return JsonResource
     * @author Mohannad Elemary
     */
    public function indexResource()
    {
        return $this->resource::collection(
            $this->getModelData(
                app(CustomerFilter::class)
            )
        );
    }
}
