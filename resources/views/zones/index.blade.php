@extends('layouts.blog')
@section('content')
<style type="text/css">
    #go{ 
        margin-top:38px;
    }
  </style>
            <link href="../resources/assets/css/jqueryscripttop.css" rel="stylesheet">
            <h1>Performances zones</h1>
             <div class="row">
                         <input id="emailFolder" type="hidden" value="{{ Auth::user()->email}}" name="">
                        <div class="form-group col-sm-2">
                          <label for="province">Province</label>
                          <select class="form-control" id="province">
                              <option value="all">Select-province</option>
                            @foreach($provinces as $province)
                               <option>{{$province->province}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-sm-3">
                          <label for="district">District</label>
                          <select class="form-control" id="district">
                            <option></option>
                          </select>
                        </div>
                         <div class="form-group col-sm-3">
                          <label for="facility">Facility</label>
                          <select class="form-control" id="facility">
                            <option></option>
                          </select>
                        </div>
                         <div class="form-group col-sm-2">
                          <button id="go" type="button" class="btn btn-primary">Go</button>
                        </div>


                   </div><!--/.row-->

              <div class="row">
              <div class="col-md-12"><h4>Coverage Indicators</h4></div>
              <div id="pageDropDown">
                <label for="rowsPerPage">Rows per Page:</label>
                <select id="rowsPerPage" name="rowsPerPage">
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="75">75</option>
                  <option value="100">100</option>
                  <option value="150">150</option>
                </select>
              </div>
              <div id="SearchBox">
                <label for="search">Search: </label>
                <input type="text" id="search" placeholder="Search data..."/>
                 <button type="button" class="btn btn-success" style="float: right;" onclick="exportToExcel('dataVue')">Export to excel<i class="material-icons">file_download</i></button><br>
              </div>
              <div>
                <div id="dataTable"></div>
                <div id="pagination"></div> 
              </div>
          </div>!--/.row-->
                   <div class="row">
                  <div id="app-tab2">
                    <tab2></tab2>
                  </div>
                   <template id="tab2-template">

                   </template>
                  <div class="col-md-12"><h4>Coverage Indicators</h4></div>
                  <div class="col-md-12">
                   <div id="app-tab">
                    <tab></tab>
                  </div>
                  <template id="tab-template">
                  <div class="table-responsive">
                    <table id="dataVue" class="table table-striped m-b-1">
                     <thead class="thead-default">
                      <tr>
                        <th class="text-left">Zones</th>
                        <th class="text-left">Facilities</th>
                        <th class="text-left">Districts</th>
                        <th class="text-left">Provinces</th>
                        <th class="text-center" colspan="3">Children Registered</th>
                        <th class="text-center" colspan="7">Coverage Rate</th>
                        <th class="text-center" colspan="7">Drop-out Rate</th>
                      </tr>
                      <tr>
                        <th></th>
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
                        <th><small>BCG/MR1</small></th>
                        <th><small>OPV1/4</small></th>
                        <th><small>DTP1/3</small></th>
                        <th><small>PCV1/3</small></th>
                        <th><small>Rota1/2</small></th>
                        <th><small>BCG/MR2</small></th>
                        <th><small>MR1/2</small></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="result in results">
                        <td class="text-left">
                           @{{ result.zone }}
                        </td>
                        <td class="text-left">
                           @{{ result.facility }}
                        </td>
                        <td class="text-left">
                           @{{ result.district }}
                        </td>
                        <td class="text-left">
                           @{{ result.province }}
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

                        <td class="text-center">
                          @{{ result.dropoutbcgmeasles1 }}
                        </td>
                        <td class="text-center">
                          @{{ result.dropoutopv }}
                        </td>
                         <td class="text-center">
                          @{{ result.dropoutdtp }}
                        </td>
                         <td class="text-center">
                          @{{ result.dropoutpcv }}
                        </td>
                         <td class="text-center">
                          @{{ result.dropoutrota }}
                        </td>
                        <td class="text-center">
                          @{{ result.dropoutbcgmeasles2 }}
                        </td>
                        <td class="text-center">
                          @{{ result.dropoutmeasles }}
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
    <script src="../resources/assets/js/dataTable/dataTable.js"></script>
    <script src="../resources/assets/js/dataTableInitializer/dataTableInitializer.js"></script>
    <script src="../resources/assets/js/chart/chart.js"></script>
    <script src="../resources/assets/js/views/vue-charts.js"></script>
    <script src="../resources/assets/js/vue.js"></script>

 <script type="text/javascript">


  $("#province").on('change', function(e){
     var province = e.target.value;
     $('#district').empty();
     $('#district').append('<option value=all>Select-district</option>');
     $.get('ajax-district?province=' + province, function(data){
        console.log(data);
         $.each(data, function(index, districtObj){
           $('#district').append('<option value="'+districtObj.district+'">'+districtObj.district+'</option>');
         });
  });
 });
  $("#district").on('change', function(e){
     var district = e.target.value;
     var province = $('#province').val();
     $('#facility').empty();
     $('#facility').append('<option value=all>Select-facility</option>');
     $.get('ajax-facility?province=' + province + '&district=' + district, function(data){
        console.log(data);
         $.each(data, function(index, facilityObj){
           $('#facility').append('<option value="'+facilityObj.health_facility+'">'+facilityObj.health_facility+'</option>');
         });
  });
 });
 </script>
 <script type="text/javascript">
  $(document).ready(function(){
    console.log("ready!");
    var emailFolder = $('#emailFolder').val(); 
    var url = window.location.href;
    var arr = url.split("/");
    var domainename = arr[0] + "//" + arr[2];
    if(domainename === 'http://localhost')
    {
       var addressUrl = domainename+'/zambia/public/json/tab/zone/'+emailFolder+'/getData.blade.php';
    }
    else{
       var addressUrl = domainename+'/json/tab/zone/'+emailFolder+'/getData.blade.php';
    }
    
    dataTable.onload(addressUrl);
  });
</script>


<script type="text/javascript">
  function tab(){
   var province = $('#province').val();
   var district = $('#district').val();
   var facility = $('#facility').val();
    if(province == 'all')
    {
      var url = '{{ route("tab_zone_json") }}';
    }
    if(province != 'all' && district == 'all')
    {
      var url = '{{ route("tab_zone_json", "province=:province") }}';
    }
    if(province != 'all' && district != 'all' && facility == 'all')
    {
      var url = '{{ route("tab_zone_json", "province=:province,district=:district") }}';
    }
    if(province != 'all' && district != 'all' && facility != 'all')
    {
      var url = '{{ route("tab_zone_json", "province=:province,district=:district,facility=:facility") }}';
    }
   url = url.replace(':province', province);
   url = url.replace(':district', district);
   url = url.replace(',', '&');
   $.getJSON(url, function(data){
      console.log("ready!");
    var emailFolder = $('#emailFolder').val();
    var url = window.location.href;
    var arr = url.split("/");
    var domainename = arr[0] + "//" + arr[2];
    if(domainename === 'http://localhost')
    {
       var addressUrl = domainename+'/zambia/public/json/tab/zone/'+emailFolder+'/getData.blade.php';
    }
    else{
       var addressUrl = domainename+'/json/tab/zone/'+emailFolder+'/getData.blade.php';
    }
     
       dataTable.onload(addressUrl); 
    });
}
setInterval(tab, 9000);
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">
  function exportToExcel(tableID){
    var province = $('#province').val();
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6' style='height: 75px; text-align: center; width: 250px'>";
    var textRange; var j=0;
    tab = document.getElementsByTagName('table')[0]; // id of table


    for(j = 0 ; j < tab.rows.length ; j++)
    {

        tab_text=tab_text;

        tab_text=tab_text+tab.rows[j].innerHTML.toUpperCase()+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text= tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); //remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer

    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write('sep=,\r\n' + tab_text);
        txtArea1.document.close();
        txtArea1.focus();
        sa=txtArea1.document.execCommand("SaveAs",true,"sudhir123.txt");
    }

    else {
       sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
    }

    return (sa);
}
</script>

 <script>


        Vue.component('tab2', {
           template: '#tab2-template',

           data: function(){
             return {
                results2: []
             }
           },

           created: function(){
              this.getData2();
           },

           methods: {
            getData2: function(){
              //var province = "Southern";
              //var district = "Sinazongwe";
              var province = $('#province').val();
              var district = $('#district').val();
              var facility = $('#facility').val();

              if(province == 'all')
              {
                 var url = '{{ route("tab_zone_json") }}';
              }
              if(province != 'all' && district == 'all')
              {
                 var url = '{{ route("tab_zone_json", "province=:province") }}';
              }
              if(province != 'all' && district != 'all' && facility == 'all')
              {
                 var url = '{{ route("tab_zone_json", "province=:province,district=:district") }}';
              }
              if(province != 'all' && district != 'all' && facility != 'all')
              {
                 var url = '{{ route("tab_zone_json", "province=:province,district=:district,facility=:facility") }}';
              }
              url = url.replace(':province', province);
              url = url.replace(':district', district);
              url = url.replace(':facility', facility);
              url = url.replace(',', '&');
              url = url.replace(',', '&');
              $.getJSON(url, function(results){
                    this.results2 = results;
              }.bind(this));

              setTimeout(this.getData2, 9000);
            }
           }


        });
        new Vue({
             el: '#app-tab2',
        });


 </script>

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
              //var district = "Sinazongwe";
              var province = $('#province').val();
              var district = $('#district').val();

              var emailFolder = $('#emailFolder').val(); 
              var url = window.location.href;
              var arr = url.split("/");
              var domainename = arr[0] + "//" + arr[2];
              if(domainename === 'http://localhost')
              {
                 var addressUrl = domainename+'/zambia/public/json/tab/zone/'+emailFolder+'/getData.blade.php';
              }
              else{
                 var addressUrl = domainename+'/json/tab/zone/'+emailFolder+'/getData.blade.php';
              }
              var url = addressUrl; 

              $.getJSON(url, function(results){
                    this.results = results;
              }.bind(this));

              setTimeout(this.getData, 10000);
            }
           }


        });
        new Vue({
             el: '#app-tab',
        });


 </script>

 <script type="text/javascript">
  function exportToExcel(tableID){
    var province = $('#province').val();
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6' style='height: 75px; text-align: center; width: 250px'>";
    var textRange; var j=0;
    tab = document.getElementsByTagName('table')[0]; // id of table


    for(j = 0 ; j < tab.rows.length ; j++)
    {

        tab_text=tab_text;

        tab_text=tab_text+tab.rows[j].innerHTML.toUpperCase()+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text= tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); //remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer

    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write('sep=,\r\n' + tab_text);
        txtArea1.document.close();
        txtArea1.focus();
        sa=txtArea1.document.execCommand("SaveAs",true,"sudhir123.txt");
    }

    else {
       sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
    }

    return (sa);
}
</script>
<script type="text/javascript">
   $('#dataVue').hide()
 </script>
@endsection
