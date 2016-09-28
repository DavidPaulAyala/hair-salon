# _Hair Salon_
###_9.23.2016_

#### By _David Ayala_

## Description

_This application will allow a salon owner to create a list of stylists and assign clients to the stylists.  The list can be manipulated by adding or removing of both client and stylist._

## Specifications

|Behavior|Input|Output|
|--------|:---:|-----:|
|Saves Stylist Name|James|James|
|Retrieves List of Stylists Names|James, Jane, Janice|James, Jane, Janice|
|Deletes entire List of Stylists Names|Delete: James, Jane, Janice|List Empty|
|Finds one Stylist from a list of stylist|Find Jane from list of James, Jane, Janice|Jane|
|Change the name of a stylist|Change James to Frank|Frank|
|Save Client Name|Sally|Sally|
|Assign Clients to Stylists|Assign Sally to James|James Clients: Sally|
|Change the name of a Client|Change Sally to Rita|Rita|
|View Stylist's Clients|View James' Clients|Sally, Sharon, Sue|
|Delete Stylist's Clients|View James' Clients|list empty|

## MySQL Commands Used (included as backup)

* _CREATE DATABASE hair_salon_
* _USE hair_salon_
* _CREATE TABLE stylists(id serial PRIMARY KEY, stylists VARCHAR(255));_
* _CREATE TABLE clients(id serial PRIMARY KEY, clients VARCHAR(255));_
* _ALTER TABLE clients ADD stylist_id int;_

## Setup Instructions

* _Clone the program from its github repository_
* _Navigate to the project directory in a command line software._
* _Type composer install_
* _Type: "cd web" to move into the "web" folder._
* _Type: "php -S localhost:8000" to create a local server for the project_
* _import the included sql.zip database files to MYSQL_
* _Open the browser of your choice and type in this URL to load the project: "localhost:8000"_

## Licensing

*This product can be used in accordance with the provisions under its MIT license.*

copyright (c) 2016 **_David Ayala_**
