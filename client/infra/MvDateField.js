export default angular.module('mv.form.date',[])
    .directive('mvDateField', function () {
        return {
            restrict : "EA",
            template : require("./mv-date-field.html"),
            scope : {
                fieldValue: "="
            },
            link : function($scope, element, attrs){

                if(typeof $scope.fieldValue !== 'undefined')
                {
                    $scope.fieldValue = $scope.fieldValue.format("YYYY-MM-DD").toString();
                }else{
                    $scope.fieldValue = new Date();
                }
            

            }
        };
}).name;