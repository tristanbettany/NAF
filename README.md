```
███╗   ██╗     █████╗     ███████╗
████╗  ██║    ██╔══██╗    ██╔════╝
██╔██╗ ██║    ███████║    █████╗  
██║╚██╗██║    ██╔══██║    ██╔══╝  
██║ ╚████║    ██║  ██║    ██║     
╚═╝  ╚═══╝    ╚═╝  ╚═╝    ╚═╝
                                  
==================================
      Its Not A Framework
==================================
```

Designed as a skeleton for creating applications quickly without the constraints and overheads of large frameworks, 
and without giving you more than what you need. You get the bare bones to make a simple website and can add to that.

The project is designed to be as DDD as possible or at least my interpretation of DDD (everyone sees it differently), 
please submit an issue if you believe changes or improvements need to be made.

## Setup

To get setup with this skeleton simply clone it and add in your database connection details in the .env file. Run composer install.
Point your web server to the index.php file in the Public folder, and you're ready to go. 

## Features

- ADR Design Pattern instead of MVC giving you greater control and organization
- PSR-7 Requests & Responses using Laminas diactoros
- Twig implementation for templating html
- ViewModels using DTO package by Spatie
- Repositories to communicate with your database
- Services for your domain logic
- Seeds using FakerPHP to create realistic data during development 
- Migrations using doctrine DBAL to version your database
- Environment variables using the popular DotEnv package
- Flip Whoops package for error handling including a custom error handler for sentry
- League Routing implementation
- PHP DI Container implementation for dependancy injection
- League config implementation
- Session handling using Laminas Session package
- User authentication Middleware
- Basic Dashboard and login setup
- Tailwind CSS for frontend
- No full fat ORM is used to save performance being tanked, however there is a custom made hydration feature 
  to hydrate entities from data in the database (if you just want to return arrays from your repos you can, 
  hydration isnt forced on you)

All of this is fairly easy to rip out if you don't need it or change the design to suit your style
or add new implementations if you need more full featured things like queuing systems and so on.
