## Installation
```
composer require ivanradojevic/urldesk
```
## Usage

```
php artisan migrate

//NovaServiceProvider
use Ivanradojevic\Urldesk\Urldesk;

public function tools()
{
	return [
		new Urldesk,
	];	
}

//Insert all Tailwind.css classes
composer require optimistdigital/nova-tailwind
```




