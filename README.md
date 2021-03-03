Installation:
	- composer require ivanradojevic/urldesk

Migrate table:
	- php artisan migrate

NovaServiceProvider:
	- use Ivanradojevic\Urldesk\Urldesk;
	- /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new Urldesk,
        ];
    }

For optimal design experience use Nova Tailwind package:
	- composer require optimistdigital/nova-tailwind

