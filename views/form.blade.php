<div>
    <h4 ng-if="dialogType=='add'" class="col-12">Add @{{home.stateParams.resName}}</h4>
    <h4 ng-if="dialogType=='edit'"  class="col-12">Edit @{{home.stateParams.resName}}</h4>
<hr />
<?= $form ?>
<div style="padding: 10px 10px;">
<button ng-if="dialogType=='add'" class="btn btn-primary btn-block" ng-click="home.store(form)">Add</button>
<button ng-if="dialogType=='edit'" class="btn btn-primary btn-block" ng-click="home.update(form)">Update</button>
@{{home.errors}}
</div>
</div>