export default class BaseCtrl {


  constructor($injector, $scope) {
    // this.random = randomNames;
    this.injector = $injector;
    this.scope = $scope;
    this.ngfUpload = this.injector.get('Upload');
    this.edsInit();
    // console.log(this.http);
  }

  edsInit() {
    console.log("init inside base");
    return false;
  }
  
    uploadFile(file, field) {
      let _self = this;
      this.ngfUpload.upload({
        method: "POST",
        url : "/files/upload",
        data : {'file' : file[0]}
      }).then(function(response){
          _self.form[field] = response.data.data.name;
          console.log(field);
      }, function(response){

      }, function(evt){
          var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
          console.log('progress: ' + progressPercentage + '% ');
      });
      console.log(this.ngfUpload);
    }




  randomName() {
    this.name = 'random name';
  }
}

BaseCtrl.$inject = ['$injector', '$scope'];
