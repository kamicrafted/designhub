<?php
namespace Craft;

class RedactorCustomPlugin extends BasePlugin {
  public function getName() {
    return Craft::t('Custom Redactor');
  }

  public function getVersion() {
    return '0.0.1';
  }

  public function getDeveloper() {
      return 'kamicrafted';
  }

  public function getDeveloperUrl() {
      return 'http://kamicrafted.com';
  }

  public function hasCpSection() {
      return false;
  }

  public function init() {
    // check we have a cp request as we don't want to this js to run anywhere but the cp
    // and while we're at it check for a logged in user as well
    if ( craft()->request->isCpRequest() && craft()->userSession->isLoggedIn() ) {

      // the includeJs method lets us add js to the bottom of the page
      craft()->templates->includeJs('var Myjs = "foo"; alert('working');');

      // the includeCss method will add css in the head
      craft()->templates->includeCss('.myFunkyPluginSelector { color: red; }');

      // the includeJsResource method will add a js file to the bottom of the page
      craft()->templates->includeJsResource('myPlugin/js/app.js');

      // the includeCssResource method will add a link in the head
      craft()->templates->includeCssResource('myFunkyPlugin/css/style.css');
    }
  }
}