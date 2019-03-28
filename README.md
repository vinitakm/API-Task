# Database

First you need to create and setup the database and import the provide file that is inside database folder.

# Config File

Check the config file the below mentioned hostname,username,password,database is as per my local configuration so setup like that or update as per your setup.
$config['db']['host_name']   = 'localhost';
$config['db']['user_name']   = 'root';
$config['db']['password']   = '';
$config['db']['database_name'] = 'anapioficeandfire';

Now connect your databse.

# Install composer
Please run the command "composer install" to install all dependencies.


# Start Server
Run the command for starting server: php -S localhost:8080
 
# End Points

Get all Books, Method:GET
localhost:8080/api/v1/books

Create A Book, Method:POST
localhost:8080/api/v1/books

Delete By ID, METHOD:DELETE
localhost:8000/api/v1/books/11

Update By ID, METHOD:DELETE
localhost:8000/api/v1/books/10 update by id put method

#RESTAPI

#Get list of Books
#Request
GET localhost:8080/api/v1/books
#Response
{
    "status_code": 200,
    "status": "success",
    "data": [
        {
        "id": "1",
        "url": "",
        "name": "A Game of Thrones",
        "isbn": "978-0553103540",
        "authors": "George R. R. Martin",
        "numberOfPages": "694",
        "publiser": "Bantam Books",
        "country": "United States",
        "mediaType": "",
        "released": "2018-08-01",
        "characters": "",
        "povCharacters": ""
        }     
    ]
}

#Get a book by ID
#Request
GET localhost:8000/api/v1/books/1

#Response
{
    "status_code": 200,
    "status": "success",
    "data": {
  
    }
}

#Add a Book
#Request
POST localhost:8080/api/v1/books

Params
url:https://www.anapioficeandfire.com/api/books/
name:A Game of Thrones1
isbn:978-05531035401
authors:George R. R. Martin1
numberOfPages:250
publiser:PPPB Ublication1
country:India
mediaType:Social
released:2018-12-02
characters:Foo,Bar
povCharacters:Hero

Response
{"status_code":200,"status":"success","message":"Book Added"}

#Update a Book
#Request
PUT localhost:8000/api/v1/books/1

Response
{
    "status_code": 200,
    "status": "success",
    "message": "Book Updated"
}

#Delete a Book
#Request
DELETE localhost:8000/api/v1/books/9

Response
{
    "status_code": 204,
    "status": "success",
    "message": "Book Deleted",
}
