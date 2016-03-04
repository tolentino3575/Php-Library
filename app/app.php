<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Author.php";
    require_once __DIR__."/../src/Book.php";
    require_once __DIR__."/../src/Checkout.php";
    require_once __DIR__."/../src/Copy.php";
    require_once __DIR__."/../src/Patron.php";

    // session_start();

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=library';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path'=>__DIR__."/../views"
    ));

    $app->get("/", function() use ($app) {
      return $app['twig']->render('index.html.twig');
    });

    $app->get("/librarian", function() use ($app) {
      return $app['twig']->render('librarian.html.twig');
    });

    $app->post("/overdue", function() use ($app) {
      //NEED TO CREATE OVERDUE METHOD
      return $app['twig']->render('overdue_list.html.twig');
    });

    $app->get("/library_status", function() use ($app) {

      return $app['twig']->render('library_status.html.twig', array('all_authors' => Author::getAll(), 'all_books' => Book::getAll()));
    });

    $app->post("/add_book", function() use ($app){
//Book Title
      $title = $_POST['title'];
      $new_book = new Book($title);
      $found_book = $new_book->save();
//Author
      $author_name = $_POST['author'];
      $new_author = new Author($author_name);
      $found_author = $new_author->save();
      if($found_author != null && $found_book != null) {
        $new_copy = new Copy($found_book->getId(), 0, null);
        $new_copy->save();
        //add a copy of the new book to our copies table

      } elseif ($found_author != null) {
        $found_author->addBook($new_book);
        $new_copy = new Copy($new_book->getId(), 0, null);
        $new_copy->save();
        //add the author to that book
        //create a copy of the new book
      } elseif ($found_book != null) {
        $found_book->addAuthor($new_author);
        $new_copy = new Copy($found_book->getId(), 0, null);
        $new_copy->save();
        // add the book to that author
        // create a copy of the book
      } else {
        $new_book->addAuthor($new_author);
        $new_copy = new Copy($new_book->getId(), 0, null);
        $new_copy->save();
        //add book to author OR author to Book
        //create new copy
      }
      return $app['twig']->render('library_status.html.twig', array('all_authors' => Author::getAll(), 'all_books' => Book::getAll()));

    });

    $app->get("/patron", function() use ($app) {
      return $app['twig']->render('patron.html.twig');
    });

    $app->get("/search_book", function() use ($app){
        $search = $_GET['search'];
        $returned_books = Book::search($search);
      return $app['twig']->render('patron.html.twig', array('books' => $returned_books));
    });

    $app->get("/book/{id}/{author_id}", function($id) use ($app){
        $book = Book::find($id);
      return $app['twig']->render('book.html.twig', array('book' => $book));
    });

    return $app;
 ?>
