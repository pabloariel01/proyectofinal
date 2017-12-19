
<style type="text/css">
    .myGrid {
        width: 100%;
        height: 50%;
    }

</style>

<div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><b>{{titulo}}</b></div>

        <div style="float: inline-end;">
          <!-- {{ayuda}} -->
          <a href data-toggle="tooltip" title={{ayuda}}>ayuda</a>
          <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="tooltip"]').on('click',function(e){
                  e.preventDefault();
                })
            });
          </script>
        </div>
    </div>
    <div class="form-group">
      ACTA:  <select  ng-options="acta as acta.descripcion for acta in actas track by acta.id" ng-model="selected"></select>


        <!-- <label for="camps"> Camps</label>
        <select multiple="" id="camps" class="selectpicker" ng-options="camp.id for camp in camps track by camp.id" ng-model="form.c">
        </select> -->

        <!-- <ui-select multiple tagging tagging-label="(custom 'new' label)" ng-model="form.a" on-remove="filtrarpor(form.a)" on-select="filtrarpor(form.a)" theme="bootstrap" sortable="true" ng-disabled="disabled" style="width: 300px;" title="elegir campania">
          <ui-select-match placeholder="campaña">
            <span ng-bind="$item.id"></span>
          </ui-select-match>
          <ui-select-choices repeat="item in (camps | filter: $select.search) track by item.id">
            <span ng-bind="item.id"></span>
          </ui-select-choices>
        </ui-select>
 -->



    </div>




              <!-- <div ng-controller="menuController"> -->
              <div  id="grid1" ui-grid="gridOptions" ui-grid-exporter class="myGrid"></div>
                  <!-- <div ui-grid="{ data: vector_especies }" class="myGrid"></div> -->
              <!-- </div> -->

    <button type="button" class="btn btn-success" ng-click="export()">Exportar</button>

          <div class="row-fluid">
              <b>total = {{total[0].total}}</b>


          </div>
      <div >
        <button  ng-click="porcentajes()" type="button" class="btn btn-primary">Porcentajes</button>
        <button  ng-click="tabla_especies()" type="button" class="btn btn-primary">totales</button>
                      <!-- <button ng-click="toggle()" ng-class="{on:b.state}" ng-repeat="b in btns">{{b.label}}</button> -->
                      <!-- <button class="md-raised md-primary md-button md-ink-ripple" type="button" aria-label="boton1"></button> -->
      </div>


       <div
            class="line-chart"
            line-chart

            line-data='vector_especies'
            line-xkey='esp'
            line-ykeys='["ITU", "ITA","ABR","PGO"]'
            line-labels='["itu", "ita","abr","pgo"]'
            line-colors='["#31C0BE", "#c7254e","#c225ff","#ff254e"]'
            resize='true'
            ymax='40%'
            ymin='20%'>
      </div>


      <!-- <canvas id="line" class="chart chart-line" chart-data="data"
          chart-labels="labels" chart-series="series" chart-options="options"
          chart-dataset-override="datasetOverride" chart-click="onClick" resize="true">
      </canvas>  -->

  </div>
 <!--  <div class="col-md-5">
      <h5>Especies</h5>
      <table class="table">
          <thead>
              <tr>
                  <th>Especies</th>
              </tr>
          </thead>
          <tbody>
              <tr ng-repeat="v in vector_especies">
                  <td>{{$index}}</td>
                  <td>{{v}}</td>
              </tr>
          </tbody>
      </table>
      <div
            class="line-chart"
            line-chart
            line-post-units="'%'"
            line-data='vector_especies'
            line-xkey='descripcion'
            line-ykeys='["ITU", "ITA","ABR","PGO"]'
            line-labels='["itu", "ita","abr","pgo"]'
            line-colors='["#31C0BE", "#c7254e","#c225ff","#ff254e"]'>
      </div>
  </div> -->
<!-- </div>
</div>
</div> -->
</div>
