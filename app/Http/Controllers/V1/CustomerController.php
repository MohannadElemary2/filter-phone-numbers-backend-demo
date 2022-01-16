<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Base\BaseController;
use App\Resources\CustomerResource;
use App\Services\CustomerService;

class CustomerController extends BaseController
{
    protected $resource = CustomerResource::class;

    public function __construct(CustomerService $service)
    {
        parent::__construct($service);
    }
}
