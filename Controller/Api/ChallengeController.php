<?php
class ChallengeController extends BaseController {

  public function listAction() {
    $strErrorDesc = '';
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $arrQueryStringParams = $this->getQueryStringParams();

    if (strtoupper($requestMethod) == 'GET') {
      try {
        $challengeModel = new ChallengeModel();

        $intLimit = 10;
        if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
          $intLimit = $arrQueryStringParams['limit'];
        }

        $arrChallenges = $challengeModel->getChallenges($intLimit);
        $responseData = json_encode($arrChallenges);
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
        array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
    } else {
      $this->sendOutput(
        json_encode(array('error' => $strErrorDesc)),
        array('Content-Type: application/json', $strErrorHeader));
    }
  }
}