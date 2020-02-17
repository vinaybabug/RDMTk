<?php 

  /*
  * Warning! Read and use at your own risk!
  *
  * This tiny proxy script is completely transparent and it passes 
  * all requests and headers without any checking of any kind.
  * The same happens with JSON data. They are simply forwarded.
  *
  * This is just an easy and convenient solution for the AJAX 
  * cross-domain request issue, during development.
  * No sanitization of input is made either, so use this only
  * if you are sure your requests are made correctly and
  * your urls are valid.
  *
  */

  if (!function_exists('getallheaders')) 
{ 
    function getallheaders() 
    { 
           $headers = ''; 
       foreach ($_SERVER as $name => $value) 
       { 
           if (substr($name, 0, 5) == 'HTTP_') 
           { 
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value; 
           } 
       } 
       return $headers; 
    } 
} 


  $method = $_SERVER['REQUEST_METHOD'];
  $endpoint = 'http://anlys.rdmtk.wise.cs.wmich.edu';


  if( true ) { 


    $headers = getallheaders();
    $headers_str = [];


    $url = $endpoint . str_replace(  '/proxy.php', '', $_SERVER['REQUEST_URI'] );

    

    foreach ( $headers as $key => $value){
      if($key == 'Host' || $key == 'Accept-Encoding')
        continue;
      $headers_str[]=$key.":".$value;
    }

    $ch = curl_init($url);

    curl_setopt($ch,CURLOPT_URL, $url);
    if( $method !== 'GET') {
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    }

    if($method == "PUT" || $method == "PATCH" || ($method == "POST" && empty($_FILES))) {
      $data_str = file_get_contents('php://input');
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_str);
      //error_log($method.': '.$data_str.serialize($_POST).'\n',3, 'err.log');
    }
    elseif($method == "POST") {
      $data_str = array();
      if(!empty($_FILES)) {
        foreach ($_FILES as $key => $value) {
          $full_path = realpath( $_FILES[$key]['tmp_name']);
          $data_str[$key] = '@'.$full_path;
        }
      }
      //error_log($method.': '.serialize($data_str+$_POST).'\n',3, 'err.log');

      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_str+$_POST);
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers_str );
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );

    $response = curl_exec($ch);

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);

    $headers = explode( "\r\n", $header );
    foreach( $headers as $v ) {
      if( ! strstr( $v, 'Content' ) ) {
        header($v);
      }
    }
    

    curl_close($ch);

    // header('Content-Type: application/json');
    echo $body;
  }
  else {
    echo $method;
    var_dump($_POST);
    var_dump($_GET);
    $data_str = file_get_contents('php://input');
    echo $data_str;

  }

