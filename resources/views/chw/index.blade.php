@extends('layouts.blog')
@section('content')
        <!-- Breadcrumb -->
         <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
        <style type="text/css">
          #go{ 
            margin-top:30px;
          }
          .drop-community{
            color:#95c5e9;
          }
        </style>
    <br>
      <div class="container-fluid">

        <div class="animated fadeIn">  
                  <br>
                  <div class="row">
                   
                        <div class="form-group col-sm-2">
                          <label for="province">Province</label>
                          <select class="form-control" id="chw">
                              <option value="all">All CHW</option> 
                              <option value="active">Active CHW</option> 
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
                        <th class="text-center">Chw<br><small>(Click on)</small></th>  
                        <th class="text-center">Name</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Province</th>
                        <th class="text-center">District</th>
                        <th class="text-center">Facility</th>
                        <th class="text-center">Zone</th>
                        <th class="text-center">Location</th> 
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
                  '<th><h6 class="drop-community"></h6></th>'+ 
              '</tr>'+
                
          '</table>';
      }

      function tab(){
          var chw = $('#chw').val();  
          if(chw == 'all'){
            var url = "{{ route('all_chw_json') }}";
          }
          if(chw == 'active'){
            var url = "{{ route('chw_percent_json') }}";
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
                  { "data": "chw_name" },
                  { "data": "chw_phone" }, 
                  { "data": "province" },
                  { "data": "district" },
                  { "data": "health_facility" },
                  { "data": "zone" },
                  { "data": "location" },
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
      });

     
   
   </script> 
   <script type="text/javascript">
     $("#go").click(function() { 
          tab();
     }); 
   </script>
@endsection

    
