Installation:
- composer require ivanradojevic/urldesk

Migrate redirects table:
- php artisan migrate

NovaServiceProvider:
- use Ivanradojevic\Urldesk\Urldesk;
public function tools()
{
return [
new Urldesk,
];
}
    	
For optimal user experience use Nova Tailwind package:
- composer require optimistdigital/nova-tailwind

