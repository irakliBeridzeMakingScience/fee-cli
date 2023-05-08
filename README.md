# Commissions calculator

## Requirements

<ul>
    <li> Make </li>
    <li> Docker </li>
</ul>

## Build
Run `cp .env.example .env ` to create environment variable and fill api path <br>  
Run `make build` to build environment


## Test application
Run `make test` to test it on provided file


## Run application
Put your desired csv file into `files` directory 
Run `make csv-parse file=<file_name>`  
