This is the API that the Hoop website will use for all communications with the database. Here is a brief explanation about all functions that are available within the API as well as the requests that can be made.

*** FOR USER REGISTER ***
This call is used to Register (Add) a user to the database. The POST request is as follows:
{
  "action":"Register",
  "F_name":"John",
  "L_Name":"Doe",
  "email":"email@gmail.com",
  "phone":"0789656789",
  "password":"12Password!34"
}

*** FOR USER/ADMIN LOGIN ***
This is used for both users and admins to login. The customerID, email and isAdmin is stored in a $_SESSION variable:
{
  "action":"Login",
  "email":"email@gmail.com",
  "password":"12Password!34"
}

*** FOR GET SHOWS ***
This API call is going to be used a lot. It has functionality to get all movies, with the ability to:
search - based on id, title, director, actor_name,
filter - based on genre, rating, type,
sort - based on title,  rating, release_date.

{
  "action":"GetAllShows",
  "limit":100,
  "return":"*",
  "search":{
    "actor_name":"Tom Cruise"
  },
  "filter":{
    "rating":3
  },
  "sort":"title"
}

*** FOR ADD SHOW ***
This call will be used by Admins ONLY to add a film/show to the database
{
  "action":"AddShow"
  "type":"Movie",
  "title":"The Lord of The Rings",
  "director":"Peter Jackson"
  "rating":3,
  "description":"Movie about destroying a ring",
  "release_date":"2003-12-17"
  "studio":"Warner Brothers",
  "imgURL":"/path_to_img",
  "genre_type":"Fantasy"
  "actor_name":["Elijah Wood","Orlando Bloom","Christopher Lee"],
  "review":"Finest film ever produced"
}

*** FOR DELETE SHOW ***
This call is for Admin ONLY and allows them to DELETE a show from the database:
{
  "action":"DeleteShow",
  "title":"The Lord of The Rings"
}

*** FOR UPDATE SHOW ***
Update show checks if fields are full and if they are, then it updates the db. The only required fields are action and title
{
    "action":"UpdateShow",
    "title":"Rising Sun",
    "director":"Some guy",
    "rating":3,
    "description":"Cool movie about something",
    "release_date":"2015-05-05",
    "studio":"Warner Brothers",
    "genre_type":"Comedy",
    "actor_name":"ELIJAH WOOD",
    "review":"pretty cool"
}

*** FOR ADD REVIEW ***
This function allows a user to add a review to any show. The contentID part is the id of that specific show (It should be returned by the getShow function)
{
  "action":"AddReview",
  "id":contentID,
  "review":"I think this movie is cool or whatever"
}

*** FOR ADD TO FAVOURITES ***
This function adds a specific show to favourites. The customerID can be retrieved through the session variable that it is stored in.
The contentID is the id of the specific show in question. The approach to implementing the Favourites Page should use the contentID that is stored in the in the favourites table and using that id with the getShow function (since you can search for an id).
{
  "action":"AddToFavourites",
  "customerID":customerID,
  "contentID":contentID
}

*** FOR DELETE FROM FAVOURITES ***
This function simply removes that show from that user's favourites
{
  "action":"DeleteFavourites",
  "contentID":contentID
}
