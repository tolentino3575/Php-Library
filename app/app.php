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

      return $app['twig']->render('library_status.html.twig', array('total' => Copy::getAll(), 'checked_in' => Copy::getAllCheckedIn(), 'checked_out' => Copy::getAllCheckedOut()));
    });

    $app->post("/", function() use ($app){
      $name = $_POST['name'];
      $new_author = new Author($name, $id);
      $found_author = $new_author->save($name);
      if($found_author != null) {
        
      }
    });

    return $app;
 ?>
