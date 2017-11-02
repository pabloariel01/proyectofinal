
<div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><b>{{titulo}}</b></div>
    </div>
    <div class="form-group">
      <div class="">


      <label for="actas"> Actas:</label>
        <select  id="actas" ng-options="acta as acta.descripcion for acta in actas track by acta.id" ng-model="selected"></select>
</div>
<div class="">
        <label for="locs"> Localidades</label>
        <!-- <select multiple="" id="camps" class="selectpicker" ng-options="camp.id for camp in camps track by camp.id" ng-model="form.c">
        </select> -->

<ui-select  id="locs" ng-model="form.a" on-select="actualizarTabla()" theme="bootstrap" sortable="true" ng-disabled="disabled" style="width: 300px;" title="elegir localidad">
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
        <div ui-grid="{ data: vector_especies }" class="myGrid"></div>
    <!-- </div> -->
    <!-- <button type="button" class="btn btn-success" ng-click="export()">Exportar</button> -->



   <div
      bar-chart
      bar-data='vector_especies'
      bar-x='campaña'
      stacked= 'true'
      bar-y='["peso AC", "peso redes"]'
      bar-labels='["peso AC", "peso redes"]'
      bar-colors='["#31C0BE", "#c7254e"]'>

    </div>

    <div
       bar-chart
       bar-data='vector_especies'
       bar-x='campaña'
       stacked= 'true'
       bar-y='["AC","total redes"]'
       bar-labels='[" total AC","total en redes"]'
       bar-colors='["#c225ff","#ff254e"]'>

    </div>
</div>
