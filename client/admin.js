//import  "../node_modules/tinymce/tinymce.min"

import uiRouter from "angular-ui-router"
import ngDialog from "ng-dialog"
import angularAnimate from "angular-animate"
import popOver from "../node_modules/angular-ui-bootstrap/src/popover"
import angularSanitize from 'angular-sanitize'
import toastr from 'angular-toastr'
import ngFileUpload from "ng-file-upload"
import 'angular-ui-tinymce';
import './main.scss'



import mvDate from './infra/MvDateField'
import routes from './admin/routes.js'
import table from './admin/components/table';


angular.module('admin', [
    uiRouter, 
    ngDialog , 
    table, 
    mvDate, 
    angularAnimate, 
    angularSanitize, 
    toastr, 
    popOver,
    ngFileUpload,
    'ui.tinymce'
]);

angular.module('admin').config(routes);

