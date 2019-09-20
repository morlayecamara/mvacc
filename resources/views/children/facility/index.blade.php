@extends('layouts.blog')
@section('content')
        <!-- Breadcrumb -->
        <style type="text/css">
          #go{ 
            margin-top:30px;
          }
        </style>
    <br>
     <h1>{{$province}}/{{$district}}/{{$facility}}</h1>
     <input id="province" type="hidden" value="{{ Auth::user()->province }}" name="">
     <input id="district" type="hidden" value="{{ Auth::user()->district }}" name="">
     <input id="facility" type="hidden" value="{{ Auth::user()->facility }}" name="">
      <div class="container-fluid">

        <div class="animated fadeIn">  
                  <br>
                  <div class="row">  
                        <div class="form-group col-sm-2">
                          <label for="zone">Zone</label>
                          <select class="form-control" id="zone">
                            <option></option> 
                          </select>
                        </div> 
                         <div class="form-group col-sm-2">  
                          <button id="go" type="button" class="btn btn-primary">Go</button>
                        </div>
                   

                   </div><!--/.row-->
                   <div class="table table-responsive">
                    <table id="example" class="table table-striped m-b-1">
                    <thead class="thead-default">
                      <tr>
                        <th class="text-center">Children<br><small>(Click on)</small></th> 
                        <th class="text-center">Age<br><small>Month</small></th>  
                        <th class="text-center">Province<br><small> </small></th>
                        <th class="text-center">District<br><small> </small></th>
                        <th class="text-center">Facility<br><small> </small></th>
                        <th class="text-center">Comm.<br>Zone</th>
                        <th class="text-center">BCG<br><small></small></th>
                        <th class="text-center">OPV<br><small></small></th>
                        <th class="text-center">PCV<br><small></small></th>
                        <th class="text-center">DTP<br><small></small></th> 
                        <th class="text-center">RV<br><small></small></th>
                        <th class="text-center">MR<br><small></small></th>
                        <th class="text-center">Fully<br><small></small></th> 
                        <th class="text-center">Joined<br><small>Date</small></th> 
                      </tr> 
                    </thead> 
                  </table> 
                 </div>
                </div>
              </div>
            </div>
            <!--/.col-->
          </div>
          <!--/.row-->
        </div>

      </div>
    <script src="../resources/assets/vendor/jquery/jquery.min.js"></script>
    <script src="../resources/assets/js/app.min.js"></script>  
    <script src="../resources/assets/js/communityregister/select.drop.down.js"></script> 
    <script src="../resources/assets/dynatable/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
      /* Formatting function for row details - modify as you need */
      function format(d) {
          // `d` is the original data object for the row
                    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:25px;">'+
              '<tr>'+ 
                  '<td><h6>Children Information</h6></td>'+
              '</tr>'+
              '<tr>'+ 
                  '<td>ID:</td>'+
                  '<td>'+d.mvacc_id+'</td>'+
                  '<td>Sex:</td>'+
                  '<td>'+d.sex+'</td>'+ 
              '</tr>'+
              '<tr>'+ 
                  '<td>DOB:</td>'+
                  '<td>'+d.dob+'</td>'+ 
                  '<td>Age:</td>'+
                  '<td>'+d.age+' months</td>'+ 
              '</tr>'+
               '<tr>'+ 
                  '<td><h6>Contact Information</h6></td>'+
                   '<td>Parents:</td>'+
                   //Add Parent name
                  '<td>'+d.mother_phone+'</td>'+
                  '<td>Volunteer:</td>'+
                  '<td>'+d.chw_phone+'</td>'+
                  //Add Volunteer name
              '</tr>'+
              '<tr>'+ 
                  '<td><h6>Vaccines</h6></td>'+
              '</tr>'+
              '<tr>'+ 
                  '<td>BCG:</td>'+
                  '<td>'+d.bcg+' dose(s)</td>'+ 
              '</tr>'+
              '<tr>'+ 
                  '<td>OPV:</td>'+
                  '<td>'+d.opv+' dose(s)</td>'+ 
              '</tr>'+
              '<tr>'+  
                  '<td>DTP:</td>'+
                  '<td>'+d.dtp+' dose(s)</td>'+ 
              '</tr>'+
              '<tr>'+  
                  '<td>PCV:</td>'+
                  '<td>'+d.pcv+' dose(s)</td>'+ 
              '</tr>'+
              '<tr>'+ 
                  '<td>Rota:</td>'+
                  '<td>'+d.rota+' dose(s)</td>'+ 
              '</tr>'+
              '<tr>'+  
                  '<td>Measles:</td>'+
                  '<td>'+d.measles+' dose(s)</td>'+ 
              '</tr>'+  
          '</table>';
      }

      function tab(){
          var province = $('#province').val();
          var district = $('#district').val();
          var facility = $('#facility').val();
          var zone = $('#zone').val();
          if(province == 'all'){
            var url = "{{ route('children_community_facility_json') }}";
          }
          if(province != 'all' && district == 'all'){ 
            var url = '{{ route("children_community_facility_json", "province=:province") }}';
            url = url.replace(':province', province);
          }
          if(province != 'all' && district != 'all' && facility == 'all'){ 
            var url = '{{ route("children_community_facility_json", "province=:province,district=:district") }}';
            url = url.replace(':province', province);
            url = url.replace(':district', district);
            url = url.replace(',', '&'); 
          }
          if(province != 'all' && district != 'all' && facility != 'all' && zone == 'all'){ 
            var url = '{{ route("children_community_facility_json", "province=:province,district=:district,facility=:facility") }}';
            url = url.replace(':province', province);
            url = url.replace(':district', district);
            url = url.replace(':facility', facility);
            url = url.replace(',', '&'); 
            url = url.replace(',', '&');
          }
          if(province != 'all' && district != 'all' && facility != 'all' && zone != 'all'){ 
            var url = '{{ route("children_community_facility_json", "province=:province,district=:district,facility=:facility,zone=:zone") }}';
            url = url.replace(':province', province);
            url = url.replace(':district', district);
            url = url.replace(':facility', facility);
            url = url.replace(':zone', zone);
            url = url.replace(',', '&'); 
            url = url.replace(',', '&');
            url = url.replace(',', '&');
          }
          
          var table = $('#example').DataTable({  
               'ajax': {
               'url': url
            },
              "columns": [
                  {
                      "className":      'details-control',
                      "orderable":      false,
                      "data":           null,
                      "defaultContent": ''
                  },
                  { "data": "age" }, 
                  { "data": "province" },
                  { "data": "district" },
                  { "data": "health_facility" },
                  { "data": "zone" },
                  { "data": "bcg" },
                  { "data": "opv" },
                  { "data": "dtp" },
                  { "data": "pcv" }, 
                  { "data": "rota" },
                  { "data": "measles" },
                  { "data": "fully" },
                  { "data": "created_at" },
              ],
              "order": [[1, 'asc']],
              "destroy" : true
          });
           
          // Add event listener for opening and closing details
          $('#example tbody').on('click', 'td.details-control', function () {
              var tr = $(this).closest('tr');
              var row = table.row(tr);
       
              if (row.child.isShown()) {
                  // This row is already open - close it
                  row.child.hide();
                  tr.removeClass('shown');
              }
              else {
                  // Open this row
                  row.child(format(row.data())).show();
                  tr.addClass('shown');
              }
          });
      }
      $(document).ready(function() {  
          tab();  
          var province = $('#province').val(); 
          var district = $('#district').val();  
          var facility = $('#facility').val();  
		     $('#zone').empty(); 
		     $('#zone').append('<option value=all>Select-zone</option>'); 
		     $.get('ajax-zone?province='+province+'&district='+district+'&facility='+facility, function(data){ 
		        $.each(data, function(index, zoneObj){ 
		           $('#zone').append('<option value="'+zoneObj.zone+'">'+zoneObj.zone+'</option>');
		        });
		  });
      });

     
   
   </script> 
   <script type="text/javascript">
     $("#go").click(function() { 
          tab();
     }); 
   </script>
@endsection

    
