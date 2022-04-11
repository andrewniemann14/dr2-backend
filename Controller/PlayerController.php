<?php
// 
class PlayerController extends BaseController {

  public function controlPlayer() {
    $strErrorDesc = '';
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $arrQueryStringParams = $this->getQueryStringParams();

    if (strtoupper($requestMethod) == 'GET') {
      try {
        $playerDao = new PlayerDao();

        // SET PARAMETERS
        $strName = null;
        if (isset($arrQueryStringParams['name']) && $arrQueryStringParams['name']) {
          $strName = str_replace('%20', ' ', $arrQueryStringParams['name']);
        }
        $intLimit = null;
        if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
          $intLimit = $arrQueryStringParams['limit'];
        }

        // CALL APPROPRIATE FUNCTION
        if (isset($strName)) {
          $arrResults = $playerDao->getPlayer($strName);
        } else if (isset($intLimit)) {
          $arrResults = $playerDao->getPlayersTopPoints($intLimit);
        }

        $responseData = json_encode($arrResults);
      } catch (Error $e) {
        $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support';
        $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
      }

    } else {
      $strErrorDesc = 'Method not supported';
      $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
    }

    // output
    if (!$strErrorDesc) {
      $this->sendOutput(
        $responseData,
        array('Content-Type: application/json', 'HTTP/1.1 200 OK', 'Access-Control-Allow-Origin: *'));
    } else {
      $this->sendOutput(
        json_encode(array('error' => $strErrorDesc)),
        array('Content-Type: application/json', $strErrorHeader));
    }
  }
}