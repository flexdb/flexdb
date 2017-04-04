export default class BaseService {


  constructor($injector) {


    this.injector = $injector;
    console.log(this.injector);

    this.edsInit();
  }

  edsInit() {
    console.log("init inside base");
    return false;
  }

}

BaseService.$inject = ['$injector'];
