import BaseCtrl from '../../../infra/BaseCtrl.js'
import '../../../../node_modules/ng-dialog/css/ngDialog.css'
import '../../../../node_modules/ng-dialog/css/ngDialog-theme-default.css'


export default class HomeController extends BaseCtrl {

  edsInit() {
    this.ngDialog = this.injector.get('ngDialog')
    this.stateParams = this.injector.get('$stateParams');
    this.tables = this.injector.get('TableService');
//    this.resName = this.stateParams.resName
    this.http = this.injector.get('$http')
//    console.log("init in child " + this.resName);
    this.get();
//    return true;
  }

  add() {

    const ngDialog = this.ngDialog
    const stateParams = this.stateParams;
    const _scope = this.scope;
    let resName = stateParams.resName;
    this.targetTable = resName;

    _scope.dialogType='add'
    _scope.form = {}

    this.addDialog = ngDialog.open({
                template: '/forms/' + resName,
                scope: _scope,
                width: '80%'
            });
  }

  edit(data, index) {

    const ngDialog = this.ngDialog
    const stateParams = this.stateParams;
    const _scope = this.scope;
    
    _scope.dialogType='edit'

    this.editIndex = index;

    let resName = stateParams.resName;
    this.targetTable = resName;

    _scope.form = angular.copy(data);

    this.addDialog = ngDialog.open({
                template: '/forms/' + resName,
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

    console.log(this.resName);

    this.http({method: "POST", url : "/api/" + table, 'data': data })
        .then((response) => {
          let newItem = response.data;
          console.log(response);
          // this.items.push(newItem);
// TODO: change to push new item, current hack to allow display title
          this.list(); 
          this.addDialog.close();
        });

  }


  get() {

    return this.tables.all().then(($tableList) => {
        return this.menuItems = this.tables.list;
    });
  }
}
