<?php
include_once 'BootstrapPage.php';
/**
 * An AngularPage class
 *
 * The AngularPage class is an extended class of basic HtmlPage class.
 *
 * @package    MyProject
 * @subpackage Common
 * @author     Venu S Dharan <venusdharan@gmail.com>
 */
class AngularPage extends BootstrapPage {
    function __construct($webpageTitle) {
        parent::__construct($webpageTitle);
        parent::addtoheadscript('./lib/angular/angular.min.js');
    }
}
