This is the code that was used to make API calls to the TMDB api database to get movie and TV show data. After receiving the data, it extracts the relevant information and populates our hoop database as follows:

This script provides the following functionality:

Fetching Movies: The getMovies() method retrieves movie data from the TMDB API and inserts it into the database by passing it to the loadMovieData() function in config.php (explained later).
Fetching TV Shows: The getShows() method retrieves TV show data from the TMDB API and inserts it into the database by passing it to the loadShowData() function in config.php.

How It Works:
Initialization: The script starts by initializing a connection to the TMDB API and the local database using the config.php file.
API Requests: It then makes HTTP requests to the TMDB API to fetch movie and TV show data. For each movie or TV show, it appends the details of movie/show credits and reviews.

Data Insertion: After fetching the data, the script inserts it into the local database using methods provided by the Database class.

The Database class is responsible for managing the connection to the database.
It establishes a connection to the phpmyadmin database using the provided credentials ($host, $db_name, $db_password, $student_num).
If the connection fails, it returns an error message.

Instance Handling:
The class implements the Singleton design pattern to ensure that only one instance of the database connection is created.
The instance() method ensures that only one instance of the Database class is created throughout the application. This is necessary as the api.php code executes the functions in the database class repeatedly.

Inserting Movie and Show Data:
The loadMovieData() and loadShowData() methods handle the insertion of movie and show data, respectively, into the database.
They receive data from the TMDB API and extract relevant information such as title, description, rating, director, release date, studio, image URL, genres, actors, and reviews.
The extracted data is then inserted into the database using prepared SQL statements.
Genres, actors, and reviews are associated with each movie or show and inserted into separate tables (genreAssociatedWith, actorsAssociatedWith, reviews) to establish relationships.

Error Handling:
Error handling is implemented throughout the code to catch exceptions and provide appropriate error messages.
If any data is missing or if there are errors in SQL queries or database operations, the script returns error messages along with relevant details.

Executing the code:

I created a test.php file to execute the code in the api.php and make the relevant api calls.
The require_once('api.php'); statement is used to include the PHOP file api.php, which contains the definition of the api class and its methods.

After creating the instance of the api class, I call the getMovies() and getShows() methods using the $api object.
These methods are responsible for retrieving movie and show data from the TMDB API, respectively.

Storing the Result:
The result returned by the getMovies() and getShows() methods is stored in the $result variable.
The result includes either an error message or a success message, indicating that the data has been correctly retrieved and the database populated.

Usage:
I populated the database using postman. I ftp-ed these three files to Wheatley and sent a GET request to my URL ("https://wheatley.cs.up.ac.za/u23590051/COS221/test.php) which executed the code in my test.php, sending the api requests and populating the database on phpMyAdmin.