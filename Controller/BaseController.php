<?php

class BaseController {
  public function __call($name, $arguments) {
    $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
  }

  // gets URI, returns array
  // URI = everything after domain
  protected function getUriSegment() {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode('/', $uri);
    
    return $uri;
  }
  
  // gets query params, returns array
  // query params = ?key=value?key=value
  protected function getQueryStringParams() {
    if (substr_count($_SERVER['QUERY_STRING'], '?')) {
      $qryStrSplit = explode('?', $_SERVER['QUERY_STRING']);
      $queryParams = array();
      foreach ($qryStrSplit as $q) {
        $pair = explode('=', $q);
        $queryParams[$pair[0]] = $pair[1];
      }
      return $queryParams;
    } else {
      return null;
    }
  }

  protected function sendOutput($data, $httpHeaders=array()) {
    // header_remove('Set-Cookie');

    if (is_array($httpHeaders) && count($httpHeaders)) {
      foreach($httpHeaders as $httpHeader) {
        header($httpHeader);
      }
    }

    echo $data;
    exit();
  }
}