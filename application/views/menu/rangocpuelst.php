<style>
    .block {
        padding: 15px;
    }

    .select2 > .select2-choice.ui-select-match {
        /* Because of the inclusion of Bootstrap */
        height: 29px;
    }

    .selectize-control > .selectize-dropdown {
        top: 36px;
    }
    /* Some additional styling to demonstrate that append-to-body helps achieve the proper z-index layering. */
    .select-box {
      background: #fff;
      position: relative;
      z-index: 1;
    }
    .alert-info.positioned {
      margin-top: 1em;
      position: relative;
      z-index: 10000; /* The select2 dropdown has a z-index of 9999 */
    }
</style>


<div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><b>{{titulo}}</b></div>
    </div>
    <div class="form-group">
      <div class="row">
          <label for="camps"> campañas:</label>
          <select  id="camps" ng-options="acta as acta.descripcion for acta in actas track by acta.id" ng-model="selected"></select>
      </div>
      <div class="row">
        <label for="select"> Localidades:</label>
        <ui-select id="select" ng-model="form.a" on-select="actualizarTabla()" theme="bootstrap" sortable="true" ng-disabled="disabled" style="width: 300px;" title="elegir localidad">
          <ui-select-match placeholder="localidades">
            <span ng-bind="form.a.nombre"></span>
          </ui-select-match>
          <ui-select-choices repeat="item in (localidades | filter: $select.search) track by item.idlocalidad">
            <span ng-bind="item.nombre"></span>
          </ui-select-choices>
        </ui-select>
      </div>


    </div>



    <!-- <div ng-controller="menuController"> -->
        <div  id="grid1" ui-grid="gridOptions" ui-grid-exporter class="myGrid"></div>
    <!-- </div> -->
    <button type="button" class="btn btn-success" ng-click="export()">Exportar</button>
</div>
