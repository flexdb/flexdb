//import angular from "../node_modules/angular"
import uiRouter from "angular-ui-router"
import ngDialog from "ng-dialog"
import angularAnimate from "angular-animate"
import  uiDropDown from "../../../node_modules/angular-ui-bootstrap/src/dropdown"
import angularLoadingBar from "angular-loading-bar"
import ngFileUpload from "ng-file-upload"
import flatpickr from './infra/flatpickr'
import './infra/helpers/index'
import './main.scss'

import "angularjs-datepicker"


import mvDate from './infra/MvDateField'

import routes from './app/routes.js'
import home from './app/components/home';

angular.module('nav', []);

angular.module('flexwb',
    [
        uiRouter, 
        ngDialog , 
        home, 
        mvDate, 
        angularAnimate, 
        '720kb.datepicker', 
        uiDropDown, 
        angularLoadingBar,
        flatpickr,
        ngFileUpload
    ]);

angular.module('flexwb').config(routes);

angular.module('flexwb').config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = false;
  });

export default angular.module('flexwb').name