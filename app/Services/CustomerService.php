<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use App\Services\Base\BaseService;

class CustomerService extends BaseService
{
    public function __construct(CustomerRepository $repository)
    {
        parent::__construct($repository);
    }
}
