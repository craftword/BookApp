
[![Build Status](https://travis-ci.org/craftword/BookApp.svg?branch=master)](https://travis-ci.org/craftword/BookApp)
[![Coverage Status](https://coveralls.io/repos/github/craftword/BookApp/badge.svg?branch=master)](https://coveralls.io/github/craftword/BookApp?branch=master)
## Book App (A getDev assessment for PHP Backend Developer)

The App is developed for a bookstore planning to build a mobile app in the nesrest future, but do not current have an API to make it work. 

## Introduction
We are to build apis for the book inventory where guest can view all books and details of each books with their ratings.
Users will be able create books, update the books they created and delete it. Users can also rate books only once. Guest cannot rate a book.

## API ROUTES AND USAGE

* Registration and Login <br />
POST { api/v1/register } <br />
Fields: name, email, password <br />
POST {api/v1/login} <br />
Fields: email, password
* List all books with their average ratings <br />
GET { api/v1/books } <br />
* Show a book details <br />
GET { api/v1/books/:id} <br />
* Create a book by autheticate users<br />
POST {api/v1/books} <br />
* Update a book by users <br />
Field: title, description, author, dateOfPublication, user_id <br />
PUT {api/v1/books/:id} <br />
* Delete a book <br />
DELETE {api/v1/books/:id} <br />
* Rate a book by user<br />
POST {api/v1/books/:id/ratings}


## Live Demo 
[Click here](https://book2018.herokuapp.com/) <br />
URL: https://book2018.herokuapp.com/


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
