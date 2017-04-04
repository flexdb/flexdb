import angular from 'angular';
import uirouter from 'angular-ui-router';

import routes from './table.routes.js';
import HomeController from './table.controller.js';
import ItemController from './table.item.controller.js'
import MenuController from './table.menu.controller.js'
import TableService from './table.service.js'
import EdsFieldService from './eds-field.service'

export default angular.module('app.table', [uirouter])
  .config(routes)
  .value('tables', ['test'])
  .service('TableService', TableService)
  .service('EdsFieldService', EdsFieldService)
  .controller('TableController', HomeController)
  .controller('ItemController', ItemController)
  .controller('MenuController', MenuController)
  .name;