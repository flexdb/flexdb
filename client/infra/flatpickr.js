import Flatpickr from "flatpickr"

export default angular.module('flatpickr',[])
    .directive('ngFlatpickr', [function() {
        return {
          require: 'ngModel',
          restrict : 'AE',
          scope : {
            fpOpts : '&',
            fpOnSetup : '&',
            ngModel: '='
          },
          link : function(scope, element, attrs, ngModel) {
            
            
            let opts = scope.fpOpts() || {};
            
            opts.onChange = (dateObj, dateStr) => { 
                ngModel.$setViewValue(dateStr);
            };
            opts.altInput = true;
            opts.altFormat = "d-m-Y"
      
            let vp = new Flatpickr(element[0], opts);
            let preLoadedDate = new Date(scope.ngModel);
            if(preLoadedDate instanceof Date) {
                vp.setDate(scope.ngModel);
            }

            if (scope.fpOnSetup) {
              scope.fpOnSetup({
                fpItem : vp
              });
            }
          }
        };
  }]).name;