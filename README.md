
## About Project
This is a simple project that fetches the customers data from SQLITE database and return it in a Restful API. There's a single endpoint that get the customer's data:

> GET /api/v1/customers

And there are 4 parameters that been sent in the request in order to make the pagination and some filtrations:

>     page: to determine the page number we want to fetch
>     per_page: to determine the page size
>     country: to filter by specific code country
>     valid: to filter by valid or invalid phone numbers

Important files:

> **routes/api.php**: contains the definition of endpoints
> 
> **app/Http/Controllers/V1**: contains the controllers that being fired when called from a route. It basiclly calls a service function.
> 
> **app/Services**: contains the services that holds the logic of the application. It's calling repositories functions as well if it needs to fetch data from the database.
> 
> **app/Repositories**: contains repositories that are responsible for communicating with the database.
> 
> **app/Resources**: contains the transformers that maps the response attributes.
> 
> **app/Models**: contains the models that represents an entity in the database.
> 
> **app/Filters**: contains filter classes that are responsible for applying filters in the query in a specific APIs when specific parameters are sent. Each function represents a specific request parameter.

## Installation

 1. clone the repository & enter the projects folder
 2. copy .env.example to a new file .env
 3. run composer install
 4. run php artisan serv
