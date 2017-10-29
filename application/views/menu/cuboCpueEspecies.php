<div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><b>{{titulo}}</b></div>
    </div>
    <div class="form-group">
        <select  ng-options="acta as acta.descripcion for acta in actas track by acta.id" ng-model="selected"></select>


        <label for="camps"> Camps</label>


        <ui-select  ng-model="form.a" on-select="actualizarTabla()" theme="bootstrap" sortable="true" ng-disabled="disabled" style="width: 300px;" title="elegir localidad">
          <ui-select-match placeholder="localidades">
            <span ng-bind="form.a.nombre"></span>
          </ui-select-match>
          <ui-select-choices repeat="item in (localidades | filter: $select.search) track by item.idlocalidad">
            <span ng-bind="item.nombre"></span>
          </ui-select-choices>
        </ui-select>

        <ui-select  ng-model="form.b" on-select="actualizarTabla()" theme="bootstrap" sortable="true" ng-disabled="disabled" style="width: 300px;" title="elegir cpue-g">
          <ui-select-match placeholder="cpue">
            <span ng-bind="form.b"></span>
          </ui-select-match>
          <ui-select-choices repeat="item in (modificador | filter: $select.search) track by item">
            <span ng-bind="item"></span>
          </ui-select-choices>
        </ui-select>


    </div>




    <!-- <div ng-controller="menuController"> -->
        <div  id="grid1" ui-grid="gridOptions" ui-grid-exporter class="myGrid"></div>
    <!-- </div> -->
        <button type="button" class="btn btn-success" ng-click="export()">Exportar</button>
</div>
