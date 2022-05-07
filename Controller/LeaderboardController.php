<?php
// 
class LeaderboardController extends BaseController {

  public function controlLeaderboard() {
    $strErrorDesc = '';
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $arrQueryStringParams = $this->getQueryStringParams();

    if (strtoupper($requestMethod) == 'GET') {
      try {
        $leaderboardDao = new LeaderboardDao();

        // SET PARAMETERS
        $strName = null;
        if (isset($arrQueryStringParams['name']) && $arrQueryStringParams['name']) {
          $strName = str_replace('%20', ' ', $arrQueryStringParams['name']);
        }
        $strStage = null;
        if (isset($arrQueryStringParams['stage']) && $arrQueryStringParams['stage']) {
          $strStage = str_replace('%20', ' ', $arrQueryStringParams['stage']);
        }
        $strClass = null;
        if (isset($arrQueryStringParams['class']) && $arrQueryStringParams['class']) {
          $strClass = $arrQueryStringParams['class'];
        }
        $intLimit = null;
        if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
          $intLimit = $arrQueryStringParams['limit'];
        }

        $intId = null;
        if (isset($arrQueryStringParams['id']) && $arrQueryStringParams['id']) {
          $intId = $arrQueryStringParams['id'];
        }

        // CALL APPROPRIATE FUNCTION
        if (!isset($strName) && isset($strStage) && !isset($strClass)) {
          $arrResults = $leaderboardDao->getFastestGlobalsForStage($strStage);
        }
        if (!isset($strName) && isset($strStage) && isset($strClass)) {
          $arrResults = $leaderboardDao->getFastestGlobalsForStageAndClass($strStage, $strClass, $intLimit);
        }
        if (isset($strName) && isset($strStage) && isset($strClass)) {
          $arrResults = $leaderboardDao->getFastestPersonalForStageAndClass($strName, $strStage, $strClass);
        }
        if (isset($strName) && !isset($strClass) && isset($strStage) && !isset($intLimit)) {
          $arrResults = $leaderboardDao->getFastestPersonalsForStagePerClass($strName, $strStage);
        }
        if (isset($strName) && !isset($strClass) && isset($strStage) && isset($intLimit)) {
          $arrResults = $leaderboardDao->getFastestPersonalsForStage($strName, $strStage, $intLimit);
        }
        if (isset($strName) && !isset($strClass) && !isset($strStage) && isset($intLimit)) {
          $arrResults = $leaderboardDao->getRecentPersonals($strName, $intLimit);
        }
        if (isset($strName) && !isset($strClass) && !isset($strStage) && !isset($intLimit)) {
          $arrResults = $leaderboardDao->getAllPersonals($strName);
        }

        if (isset($intId)) {
          $arrResults = $leaderboardDao->getSingleLeaderboard($intId);
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