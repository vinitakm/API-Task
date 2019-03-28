<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/vendor/autoload.php';
include 'config.php';

$configuration = [
    'settings' => $config
];


$container = new \Slim\Container($configuration);
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host_name'] . ';dbname=' . $db['database_name'],
        $db['user_name'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$app = new \Slim\App($container);


$app->group('/api/v1', function (\Slim\App $app) {

	/*To retrieve all Books*/
	$app->get('/books', function (Request $request, Response $response, array $args) {
	
		try{
		   $con = $this->db;
		   $sql = "SELECT * FROM books";     
		   $result = null;
		   foreach ($con->query($sql) as $row) {
		       $result[] = $row;
		   }
		   if($result){
		       return $response->withJson(array('status_code' => 200,'status' => 'success','data'=>$result),200);
		   }else{
		       return $response->withJson(array('status_code' => 422,'status' => 'Books Not Found'),422);
		   }
		          
		}
		catch(\Exception $ex){
		   return $response->withJson(array('status_code' => 422,'status' => 'failed','error' => $ex->getMessage()),422);
		}

	});

	/*To store/save a Book*/
	$app->post('/books', function (Request $request, Response $response, array $args) {

		if(empty($request->getParam('url')))
			return $response->withJson(array('status_code' => 422,'status' => 'failed','error' =>'The url feild is required.'),422);
		
		if(empty($request->getParam('name')))
			return $response->withJson(array('status_code' => 422,'status' => 'failed','error' =>'The name feild is required.'),422);

		if(empty($request->getParam('isbn')))
			return $response->withJson(array('status_code' => 422,'status' => 'failed','error' =>'The isbn field is required.'),422);

		if(empty($request->getParam('authors')))
			return $response->withJson(array('status_code' => 422,'status' => 'failed','error' =>'The authors field is required.'),422);
		
		try{
			$con = $this->db;
			$sql = "INSERT INTO `books` (`url`, `name`, `isbn`, `authors`, `numberOfPages`, `publiser`, `country`, `mediaType`, `released`, `characters`, `povCharacters`) VALUES (:url, :name, :isbn, :authors, :numberOfPages, :publiser, :country, :mediaType, :released, :characters, :povCharacters)";
			$pre  = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$values = array(
			':url'           => $request->getParam('url'),
			':name'          => $request->getParam('name'),
			':isbn'          => $request->getParam('isbn'),
			':authors'       => $request->getParam('authors'),
			':numberOfPages' => $request->getParam('numberOfPages'),
			':publiser'      => $request->getParam('publiser'),
			':country'       => $request->getParam('country'),
			':mediaType'     => $request->getParam('mediaType'),
			':released'      => $request->getParam('released'),
			':characters'    => $request->getParam('characters'),
			':povCharacters' => $request->getParam('povCharacters')
			);

			$result = $pre->execute($values);
			return $response->withJson(array('status_code' => 201,'status' => 'success','message'=>'Book Added'),201);

		} catch(\Exception $ex){
			return $response->withJson(array('status_code' => 422,'status' => 'failed','error' => $ex->getMessage()),422);
		}
	});

	/*To retrieve a Book by Id*/
	$app->get('/books/{book_id}', function (Request $request, Response $response, array $args) {
	   
		try{
			$id  = $args['book_id'];
			$con = $this->db;
			$sql = "SELECT * FROM `books` WHERE id = :id";
			$pre  = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$values = array(
			':id' => $id);
			$pre->execute($values);
			$result = $pre->fetch();
			if($result){
			   return $response->withJson(array('status_code' => 200,'status' => 'success','data'=> $result),200);
			}else{
			   return $response->withJson(array('status_code' => 422,'status' => 'Book Not Found'),422);
			}

		} catch(\Exception $ex){
			return $response->withJson(array('status_code' => 422,'status' => 'failed','error' => $ex->getMessage()),422);
		}
	});

	/*To update a book*/
	$app->put('/books/{book_id}', function (Request $request, Response $response, array $args) {

		if(empty($request->getParam('url')))
			return $response->withJson(array('status_code' => 422,'status' => 'failed','error' =>'The url field is required.'),422);
		
		if(empty($request->getParam('name')))
			return $response->withJson(array('status_code' => 422,'status' => 'failed','error' =>'The name field is required.'),422);

		if(empty($request->getParam('isbn')))
			return $response->withJson(array('status_code' => 422,'status' => 'failed','error' =>'The isbn field is required.'),422);

		if(empty($request->getParam('authors')))
			return $response->withJson(array('status_code' => 422,'status' => 'failed','error' =>'The authors field is required.'),422);
	   
		try{
			$id  = $args['book_id'];
			$con = $this->db;
			$sql = "UPDATE `books` SET url=:url, name=:name, isbn=:isbn, authors=:authors, numberOfPages=:numberOfPages, publiser=:publiser, country=:country, mediaType=:mediaType, released=:released, characters=:characters, povCharacters=:povCharacters WHERE id = :id";
			$pre = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$values = array(
			':url'           => $request->getParam('url'),
			':name'          => $request->getParam('name'),
			':isbn'          => $request->getParam('isbn'),
			':authors'       => $request->getParam('authors'),
			':numberOfPages' => $request->getParam('numberOfPages'),
			':publiser'      => $request->getParam('publiser'),
			':country'       => $request->getParam('country'),
			':mediaType'     => $request->getParam('mediaType'),
			':released'      => $request->getParam('released'),
			':characters'    => $request->getParam('characters'),
			':povCharacters' => $request->getParam('povCharacters'),
			':id'            => $id
			);
			$result =  $pre->execute($values);
			if($result){
				return $response->withJson(array('status_code' => 200,'status' => 'success','message'=>'Book Updated'),200);
			}else{
				return $response->withJson(array('status_code' => 422,'status' => 'success','message'=>'Book Not Found'),422);
			}

		} catch(\Exception $ex){
			return $response->withJson(array('status_code' => 422,'status' => 'failed','error' => $ex->getMessage()),422);
		}
	});

	/*To delete a Book*/
	$app->delete('/books/{book_id}', function (Request $request, Response $response, array $args) {


		try{
			$id  = $args['book_id'];
			$con = $this->db;
			$sql = "SELECT * FROM `books` WHERE id = :id";
			$pre  = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$values = array(
			':id' => $id);
			$pre->execute($values);
			$result = $pre->fetch();
			if(!$result){
			   return $response->withJson(array('status_code' => 422,'status' => 'Book Not Found'),422);
			}

		} catch(\Exception $ex){
			return $response->withJson(array('status_code' => 422,'status' => 'failed','error' => $ex->getMessage()),422);
		}


	   	try{
			$id  = $args['book_id'];
			$con = $this->db;
			$sql = "DELETE FROM `books` WHERE id = :id";
			$pre = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	       $values = array(
	       	':id' => $id
	       );
	       $result = $pre->execute($values);
	       if($result){
	           return $response->withJson(array('status_code' => 204,'status' => 'success','message'=>''.$result->name.' Book Deleted'),204);
	       }else{
	           return $response->withJson(array('status_code' => 422,'status' => 'failed','message' => 'Book Not Found'),422);
	       }
	      
	   } catch(\Exception $ex){
	       return $response->withJson(array('status_code' => 422,'error' => $ex->getMessage()),422);
	   }

	});

});

$app->run();
