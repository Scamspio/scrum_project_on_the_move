# Wander_On_The_Move

A basic Transport Management System aimed at a (fictional) business doing deliveries by trucks.

This project was Created by:  
[Tim van Loo](https://github.com/TimboooHSS) (Frontend)  
[Maurits Meijerhof](https://github.com/EnvyTheSky) (Frontend)  
[Sander Steensma](https://github.com/avmsteensma) (Backend)  


## Features

- Generating routes with multiple stops
- calculating departure/arrival time
- viewing routes on an in app map
- Saving routes to a database

## Incomplete/planned features

- Saving customers (Incomplete)
  Companies can be registered in the database but cannot be searched/selected as a destination.
- Automatic emails to customers with arrival times (Planned)
- Calendar view

# Installation

to get this project running, you need the following software:

- PHP >= 8.2
- Composer
- npm

The following PHP extensions need to enabled:

- Ctype 
- cURL 
- DOM 
- Fileinfo 
- Filter 
- Hash 
- Mbstring 
- OpenSSL 
- PCRE 
- PDO 
- Session
- Tokenizer
- XML

Once all requirements are met, run the following commands

```
git clone git@github.com:avmsteensma/scrum_project_on_the_move.git

cd wander_on_the_move

composer run setup
```

To run the project locally use:

```
composer run dev
```
