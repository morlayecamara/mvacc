@extends('layouts.blog')
@section('content') 
<style type="text/css">
  #go{ 
      margin-top:38px;
  }
</style>
            <h1>Performances districts</h1> 
             <a href="{{ route('district') }}">Go to district</a>
             <div class="row">
                   
                        <div class="form-group col-sm-2">
                          <label for="province">Province</label>
                          <select class="form-control" id="province">
                              <option value="all">Select-province</option> 
                            @foreach($provinces as $province)
                               <option>{{$province->province}}</option> 
                            @endforeach
                          </select>
                        </div> 
                         <div class="form-group col-sm-2">  
                          <button id="go" type="button" class="btn btn-primary">Go</button>
                        </div>
                   

                   </div><!--/.row-->
                 <div class="row"> 
                  <div class="col-md-12"><h4>Coverage Indicators</h4></div>
                  <div class="col-md-12">
                   <div id="app-tab">
                    <tab></tab>
                  </div>
                  <template id="tab-template"> 
                  <div class="table-responsive">
                    <table class="table table-striped m-b-1">
                     <thead class="thead-default">
                      <tr>
                        <th class="text-left">Districts</th>
                        <th class="text-left">Provinces</th>
                        <th class="text-left">Live births</th>
                        <th class="text-center" colspan="3">Children Registered</th> 
                        <th class="text-center" colspan="7">Coverage Rate</th>  
                      </tr>
                      <tr> 
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><small>Tot</small></th>
                        <th><small>12-23</small></th>
                        <th><small>18-23</small></th>
                        <th><small>Fully</small></th>
                        <th><small>BCG</small></th> 
                        <th><small>OPV</small></th> 
                        <th><small>DTP</small></th> 
                        <th><small>PCV</small></th>
                        <th><small>Rota</small></th> 
                        <th><small>MR</small></th>  
                      </tr>
                    </thead>
                    <tbody>  
                      <tr v-for="result in results">  
                        <td class="text-left">
                           @{{ result.district }}
                        </td> 
                        <td class="text-left">
                           @{{ result.province }}
                        </td> 
                        <td class="text-left">
                           @{{ result.live_births }}
                        </td> 
                        <td class="text-center">
                           @{{ result.children_023 }}
                        </td>
                        <td class="text-center">
                           @{{ result.children_1223 }}
                        </td>
                        <td class="text-center">
                           @{{ result.children_1823 }}
                        </td>
                        <td class="text-center">
                           @{{ result.fully }}
                        </td>
                        <td class="text-center">
                           @{{ result.bcg }}
                        </td>
                        <td class="text-center">
                           @{{ result.opv }}
                        </td>
                        <td class="text-center">
                           @{{ result.dtp }}
                        </td>
                        <td class="text-center">
                           @{{ result.pcv }}
                        </td>
                        <td class="text-center">
                          @{{ result.rota }}
                        </td>
                        <td class="text-center">
                          @{{ result.measles }}
                        </td> 
                      </tr>
                    </tbody>
                    </table>
                  </div>
                    <!--/.table-->
                  </template>
            </div>
                   
                    
        </div> 
        <div class="content-footer">
            <nav class="footer-right">
                <ul class="nav">
                    <li></li>
                </ul>
            </nav>
            <nav class="footer-left">
                <ul class="nav">
                    <li><a href="http://www.moh.gov.zm" target="_blank"><small>Ministry of Health- Latest update: {{ date('Y') }}</small></a> </li> 
                </ul>
            </nav>
        </div><!--content-footer-->
    <script src="../resources/assets/vendor/jquery/jquery.min.js"></script> 
    <script src="../resources/assets/js/app.min.js"></script> 
    <script src="../resources/assets/js/chart/chart.js"></script> 
    <script src="../resources/assets/js/views/vue-charts.js"></script> 
    <script src="../resources/assets/js/vue.js"></script> 
 
 <script> 
  

        Vue.component('tab', {
           template: '#tab-template',

           data: function(){
             return {
                results: []
             }
           },

           created: function(){
              this.getData();
           },

           methods: {
            getData: function(){
              //var province = "Southern";
              var province = $('#province').val();
             
              if(province == 'all')
              {
                 var url = '{{ route("tab_district_json") }}';
              }
              else
              {
                 var url = '{{ route("tab_district_json", "province=:province") }}';
              } 
              url = url.replace(':province', province); 
              $.getJSON(url, function(results){ 
                    this.results = results;
              }.bind(this));

               
            }
           }


        });
        new Vue({
             el: '#app-tab',
        });
   
 
 </script>

@endsection