## University of Oklahoma Hackathon
This is an example API built for our hackathon for the University of Oklahoma.  The purpose behind this is to motivate the students to build a minimum viable product that could later be turned into a business.

### Install the API
* `git clone git@github.com:DomAndTom/ou-hackathon-api.git`
* `composer install`
* `php artisan migrate`
* `php artisan asset:publish`
* `chmod -R 777 app/storage`

### Configure
Make sure to set your environment in bootstrap/start.php to properly detect the environment you are using