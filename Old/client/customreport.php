<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Innovention</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css" > 
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> 
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include_once('templates/nav.php');?>
<?php include_once('templates/sidenav.php');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Custom Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Custom Report</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Filter</h3>
            </div>
            <div class="card-body">
            <div class="row">
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Select Store:</label>
                        <select id="stores" class="custom-select">
                          <option value='All'>All</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Select Product:</label>
                        <select id="productids" class="custom-select">
                          <option value='All'>All</option>
                        </select>
                      </div>
                    </div>                    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Date range:</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                          <input type="text" class="form-control float-right" id="datepicker-pick">
                          
                        </div>              
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Transaction type:</label>
                        
                        <select id="typeoftransaction" class="custom-select">
                            <option value='All'>All</option>
                            <option value='All(Cash)'>All(Cash)</option>
                            <option value='All(Others)'>All(Others)</option>
                            <option value='Walk-In'>WALKIN</option>
                            <option value='Gcash'>Gcash</option>
                            <option value='Grab'>Grab</option>
                            <option value='Food Panda'>Food Panda</option>
                            <option value='Shopee Pay'>Shopee Pay</option>
                            <option value='RepExpense'>RepExpense</option>
                            <option value='Paymaya'>Paymaya</option>
                            <option value='Others'>Others</option>
                          </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Type Of Coupons:</label>
                        <div class="input-group">
                        <select id="coupon-type" class="custom-select">
                          <option value='All'>All</option>
                        </select>
                        <div class="input-group-prepend">
                              <button type="button" id="4" onclick="generateCustomreport(this.id)" class="btn btn-block btn-secondary btn-flat">Search</button>          
                         </div>
                      </div>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i>Output</h3>
                <a href="#" onclick="generateCustomReport();">Download as PDF file</a>
              </div>
            </div> -->
          <div class="col-sm-12">
              <button class="btn btn-info" style="float:right;margin:2px;" onclick="exportToExcel()"><i class="fas fa-file-excel"></i> Export To Excel</button>
              <button class="btn btn-success" style="float:right;margin:2px;" onclick="exportToPdf()"><i class="fas fa-file-pdf"></i> Export To PDF</button>
          </div>
          <div class="card-body">
          <table id="tbl_custom_report" class="table table-striped table-bordered dt-responsive" style="width:100%">
            <thead>
              <tr>
                <th>Transaction #</th>
                <th>Store Name</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Discount Type</th>
                <th>Date</th>
              </tr>
            </thead>
            <!-- <tbody id='custom_report'>
            </tbody> -->
          
          </table>
          </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </section>
  </div>
<?php include_once('templates/webfooter.php');?>
</div>

<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../dist/js/adminlte.js"></script>
<script src="../dist/js/demo.js"></script>

<script type="text/javascript">

  $(document).ready(function(){
 
    var table = $('#tbl_custom_report').DataTable({
      "responsive": true,
      "processing": true,
      searching: false,
      "pageLength": 50,
      columnDefs: [
        { width: '20%', targets: 3}
      ],    
    });

  function updateConfig() {
      var options = {};
      var options2 = {};
      options.timePicker = true;
      options2.timePicker = true;
      options.ranges = {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      };
      options2.ranges = {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      };
      $('#datepicker-pick').daterangepicker(options, function(start, end, label) {});      
    }


  updateConfig();
  LoadStores();
  LoadProductIDS(); 
  loadCoupons();
  })


  function LoadProductIDS() {
    $.ajax({
      url: 'dtserver/getproductids.php',
      type: 'post',
      dataType: 'json',
      success:function(response){     
        var len = response.length;
        for( var i = 0; i<len; i++){
            var id = response[i]['ID'];
            var name = response[i]['Name'];          
            $("#productids").append("<option value='"+id+"'>"+name+"</option>");      
        }
      }
    });
  }
  function LoadStores() {
    $("#stores").append("<option value=''>Fetching</option>")
    var session_var = "<?php echo $_SESSION['client_user_guid']; ?>";
    $.ajax({
      url: 'dtserver/getstoreids.php',
      type: 'post',
      data: {guid:session_var},
      dataType: 'json',
      success:function(response){     
        var len = response.length;
        $("#stores").empty();
        $("#stores").append("<option value='All'>All</option>")
        for( var i = 0; i<len; i++){
            var id = response[i]['id'];
            var name = response[i]['name'];          
            $("#stores").append("<option value='"+id+"'>"+name+"</option>");
        }
      }
    });
  }

  function generateCustomreport(btnid){
    if (btnid == 4){
        $("#custom-tabs-four-tabContent").append("<div id='loading' class='overlay-wrapper'><div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i></div></div>");
    }

      let dateval = $("#datepicker-pick").val();
      let storeid = $("#stores").val();
      let productid = $("#productids option:selected" ).text();
      // let sales_type = $("#typeofsales").val();
      let transaction_type = $("#typeoftransaction").val();
      let coupon_type = $("#coupon-type option:selected" ).text();
      
    $("#loading").remove();  
      
    $("#tbl_custom_report").DataTable({
       "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": false,
      "pageLength": 15,
      "bInfo" : true,
      paging: true,
      searching: false,
      "bDestroy": true,
      "ajax": {url:'dtserver/customReport.php?dateval='+dateval+'&storeid='+storeid+'&productid='+productid
      +'&transaction_type='+transaction_type+'&coupon_type='+coupon_type,dataSrc:""},
      "columns": [
        {
		    	"data": "transaction_number",
			  },
      	{
		    	"data": "store_name",
			  },
			  {
		    	"data": "name",
			  },
			  
        {
		    	"data": "quantity",
			  },
        {
		    	"data": "price",
			  },
        {
		    	"data": "total",
			  },
        {
		    	"data": "discount_type",
			  },
        {
		    	"data": "date",
			  },
			  ],
    
    });
  }
  // function search() {
  //   var storeid = $("#stores").val();
  //   var salestype = $("#salestype").val();
  //   var transactiontype =  $("#transactiontype").val();
  //   var daterange = $("#datepicker-pick").val();
  //   var table = $('#example').DataTable();
  //   $('#example').empty();
  //   table.destroy();
  //   $("#example").DataTable({
  //     "responsive": true,
  //     "autoWidth": false,
  //     "processing": true,
  //     "serverSide": true,
  //     searching: false,
  //     "ajax": "dtserver/generatecustomreport.php?storeid=" + storeid + "&salestype=" + salestype + "&transactiontype=" + transactiontype + "&daterange=" + daterange
  //   });
  // }

  // function generateCustomReport() {
  //   var storeid = $("#stores").val();
  //   var salestype = $("#salestype").val();
  //   var transactiontype =  $("#transactiontype").val();
  //   var daterange = $("#datepicker-pick").val();
  //   $.ajax({
  //     url: 'dtserver/generatecustomreport.php',
  //     type: 'get',
  //     data: {storeid:storeid, salestype:salestype, transactiontype:transactiontype, daterange:daterange},
  //     dataType: 'json',
  //     success:function(response){    
  //       alert(response.data);
  //     }
  //   });
  // }
  function exportToExcel(){
    let dateval = $("#datepicker-pick").val();
    let storeid = $("#stores").val();
    let productid = $("#productids option:selected" ).text();
    // let sales_type = $("#typeofsales").val();
    let transaction_type = $("#typeoftransaction").val();
    let coupon_type = $("#coupon-type option:selected" ).text();
    
    var win = window.open(window.location.origin+'/admin/print/customReportExcel.php?dateval='+dateval+'&storeid='+storeid+'&productid='+productid
      +'&transaction_type='+transaction_type+'&coupon_type='+coupon_type);
        win.focus();
  }
  function exportToPdf(){
    let dateval = $("#datepicker-pick").val();
    let storeid = $("#stores").val();
    let productid = $("#productids option:selected" ).text();
    // let sales_type = $("#typeofsales").val();
    let transaction_type = $("#typeoftransaction").val();
    let coupon_type = $("#coupon-type option:selected" ).text();
    
    var win = window.open(window.location.origin+'/client/print/customReportPDF.php?dateval='+dateval+'&storeid='+storeid+'&productid='+productid
      +'&transaction_type='+transaction_type+'&coupon_type='+coupon_type);
        win.focus();
        
  }
  function loadCoupons(){
    $.getJSON('dtserver/getCouponList.php', function(response) {
     
          for( var i = 0; i<response.length; i++){
              $('#coupon-type').append('<option value='+response[i].id+'>'+response[i].name+'</option>')   
          } 
      })
  }
</script>

</body>
</html>
    
