import BaseCtrl from '../../../infra/BaseCtrl.js'
import HttpErrorHandler from '../../../infra/helpers/HttpErrorHandler.js'
import '../../../../../../node_modules/ng-dialog/css/ngDialog.css'
import '../../../../../../node_modules/ng-dialog/css/ngDialog-theme-default.css'
import '../../../../../../node_modules/angularjs-datepicker/dist/angular-datepicker.css'


export default class HomeController extends BaseCtrl {

  edsInit() {
    this.ngDialog = this.injector.get('ngDialog')
    this.stateParams = this.injector.get('$stateParams');
    this.resName = this.stateParams.resName
    this.http = this.injector.get('$http')
    
    console.log("init in child " + this.resName);
    this.list();
    this.form = {};
    return true;
    
  }

  add() {

    const ngDialog = this.ngDialog
    const stateParams = this.stateParams;
    const _scope = this.scope;
    let resName = stateParams.resName;
    this.targetTable = resName;

    _scope.dialogType='add'
    _scope.form = {}
    this.form = {}

    this.addDialog = ngDialog.open({
                template: '/eds-forms/' + resName,
                scope: _scope,
                width: '80%'
            });

    this.errors = [];
  }

  edit(data, index) {

    const ngDialog = this.ngDialog
    const stateParams = this.stateParams;
    const _scope = this.scope;
  

    _scope.dialogType='edit'

    this.editIndex = index;

    let resName = stateParams.resName;
    this.targetTable = resName;

    this.form = angular.copy(data);

    this.addDialog = ngDialog.open({
                template: '/eds-forms/' + resName,
                scope: _scope,
                width: '80%'
            });

  }

  update(data, index) {

      if(typeof data == 'undefined')  {
      return false;
    }

    let tempData = data;

    this.http({method: "PUT", url : "/api/" + this.targetTable + "/" + data.id, 'data': data })
        .then((response) => {

          // this.items[this.editIndex] = data;
          this.list();
          this.addDialog.close();
        });

  }

  del(item, index) {

    this.http({method: "DELETE", url : "/api/" + this.resName + "/" + item.id })
        .then((response) => {
          console.log(index);
          console.log(this.items);
          this.items.splice(index, 1);
        });
  }

  store(data) {

    let table = this.targetTable;

    if(typeof data == 'undefined')  {
      return false;
    }

    this.http({method: "POST", url : "/api/" + table, 'data': data })
        .then((response) => {
          let newItem = response.data;
          this.list();
          this.form = {};
          this.addDialog.close();
        }).catch((response) => HttpErrorHandler(response, this));

  }

  list() {

    return this.http({method: "GET", 'url' : "/api/" + this.resName })
        .then((response) => {
          this.items = response.data

        });
  }

  handleError(response) {
      console.log(response);

  }


}
