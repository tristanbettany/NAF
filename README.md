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

The project is designed to be as DDD as possible or at least my interpretation of DDD, please submit an issue if you 
believe changes or improvements need to be made.

## Setup

To get setup with this skeleton simply clone it and add in your database connection details in the .env file. Run composer install.
Point your web server to the index.php file in the Public folder and your ready to go. 

## Features

- ADR Design Pattern instead of MVC
- Twig implimentation for templating html
- Example ViewModel classes
- Example Gateway classes
- Example Service classes
- Example Service Providers
- Example Adction classes
- Example database seed classes
- Environment variable loading
- Flip Whoops for error handling
- League Routing implimentation
- League Container implimentation for dependancy injection
- League config implimentation
- Doctrine migrations implimentation for versioning your database
- FakerPHP for use in seeds

All of this is fairly easy to rip out if you dont need it or change the design to suit your style
or add new implimentations if you need more full featured things like queuing systems and so on.
