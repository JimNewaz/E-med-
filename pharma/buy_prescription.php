<?php 
  if( !session_start() ){ session_start(); }
  error_reporting(0);
	include('includes/config.php');
	
	# verify login
  if(!isset($_SESSION['login']) || !$_SESSION['login']){
		header('Location: company_login.php');
		exit;
	}
	
	
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>E Med - Buy Prescription</title>
  <?php include('includes/links.php')?>
	<style>
		.pagination{display:inline-block;padding-left:0;margin:20px 0;border-radius:4px}
		.pagination>li{display:inline}.pagination>li>a,.pagination>li>span{position:relative;float:left;padding:6px 12px;line-height:1.42857143;text-decoration:none;color:#428bca;background-color:#fff;border:1px solid #ddd;margin-left:-1px}.pagination>li:first-child>a,.pagination>li:first-child>span{margin-left:0;border-bottom-left-radius:4px;border-top-left-radius:4px}.pagination>li:last-child>a,.pagination>li:last-child>span{border-bottom-right-radius:4px;border-top-right-radius:4px}.pagination>li>a:hover,.pagination>li>span:hover,.pagination>li>a:focus,.pagination>li>span:focus{color:#2a6496;background-color:#eee;border-color:#ddd}.pagination>.active>a,.pagination>.active>span,.pagination>.active>a:hover,.pagination>.active>span:hover,.pagination>.active>a:focus,.pagination>.active>span:focus{z-index:2;color:#fff;background-color:#428bca;border-color:#428bca;cursor:default;}.pagination>.disabled>span,.pagination>.disabled>span:hover,.pagination>.disabled>span:focus,.pagination>.disabled>a,.pagination>.disabled>a:hover,.pagination>.disabled>a:focus{color:#999;background-color:#fff;border-color:#ddd;cursor:not-allowed}.pagination-lg>li>a,.pagination-lg>li>span{padding:10px 16px;font-size:18px}.pagination-lg>li:first-child>a,.pagination-lg>li:first-child>span{border-bottom-left-radius:6px;border-top-left-radius:6px}.pagination-lg>li:last-child>a,.pagination-lg>li:last-child>span{border-bottom-right-radius:6px;border-top-right-radius:6px}.pagination-sm>li>a,.pagination-sm>li>span{padding:5px 10px;font-size:12px}.pagination-sm>li:first-child>a,.pagination-sm>li:first-child>span{border-bottom-left-radius:3px;border-top-left-radius:3px}.pagination-sm>li:last-child>a,.pagination-sm>li:last-child>span{border-bottom-right-radius:3px;border-top-right-radius:3px}.pager{padding-left:0;margin:20px 0;list-style:none;text-align:center}.pager li{display:inline}.pager li>a,.pager li>span{display:inline-block;padding:5px 14px;background-color:#fff;border:1px solid #ddd;border-radius:15px}.pager li>a:hover,.pager li>a:focus{text-decoration:none;background-color:#eee}.pager .next>a,.pager .next>span{float:right}.pager .previous>a,.pager .previous>span{float:left}.pager .disabled>a,.pager .disabled>a:hover,.pager .disabled>a:focus,.pager .disabled>span{color:#999;background-color:#fff;cursor:not-allowed}.label{display:inline;padding:.2em .6em .3em;font-size:75%;font-weight:700;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:.25em}.label[href]:hover,.label[href]:focus{color:#fff;text-decoration:none;cursor:pointer}.label:empty{display:none}.btn .label{position:relative;top:-1px}.label-default{background-color:#999}.label-default[href]:hover,.label-default[href]:focus{background-color:gray}.label-primary{background-color:#428bca}.label-primary[href]:hover,.label-primary[href]:focus{background-color:#3071a9}.label-success{background-color:#5cb85c}.label-success[href]:hover,.label-success[href]:focus{background-color:#449d44}.label-info{background-color:#5bc0de}.label-info[href]:hover,.label-info[href]:focus{background-color:#31b0d5}.label-warning{background-color:#f0ad4e}.label-warning[href]:hover,.label-warning[href]:focus{background-color:#ec971f}.label-danger{background-color:#d9534f}.label-danger[href]:hover,.label-danger[href]:focus{background-color:#c9302c}.badge{display:inline-block;min-width:10px;padding:3px 7px;font-size:12px;font-weight:700;color:#fff;line-height:1;vertical-align:baseline;white-space:nowrap;text-align:center;background-color:#999;border-radius:10px}.badge:empty{display:none}.btn .badge{position:relative;top:-1px}.btn-xs .badge{top:0;padding:1px 5px}a.badge:hover,a.badge:focus{color:#fff;text-decoration:none;cursor:pointer}a.list-group-item.active>.badge,.nav-pills>.active>a>.badge{color:#428bca;background-color:#fff}.nav-pills>li>a>.badge{margin-left:3px}.jumbotron{padding:30px;margin-bottom:30px;color:inherit;background-color:#eee}.jumbotron h1,.jumbotron .h1{color:inherit}.jumbotron p{min-bottom:15px;font-size:21px;font-weight:200}
		.pagination,.bootgrid-header .pagination{margin:0!important}
		.pagination>li { cursor:pointer; }
	</style>
</head>

<body>

  <header>
    <?php include('includes/header.php')?>
  </header>

  <section class="page-title">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block text-center">
            <h1>BUY PRESCRIPTIONS</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="prescription section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
					<table id="grid-basic" class="table table-condensed table-hover table-striped">
					<thead>
					<tr>
					  <th data-column-id="id" data-type="numeric" data-order="desc" data-identifier="true">ID</th>
					  <th data-column-id="hospital">Hospital</th>
					  <th data-column-id="doctor">Doctor</th>
					  <th data-column-id="disease_type">Disease Type</th>
					  <th data-column-id="upload_date">Upload Date</th>
					  <th data-column-id="image" data-formatter="link" data-sortable="false">Image</th>
					</tr>
					</thead>
					<tbody>
					<?php 
					$query=mysqli_query($con,"select * from prescriptions WHERE status = 1");
					$cnt=0;
					while($row=mysqli_fetch_array($query))
					{
						$cnt++;
					?>
					<tr>
					  <td><?php echo $row['id']; ?></td>
					  <td><?php echo $row['hospital']; ?></td>
					  <td><?php echo $row['doctor']; ?></td>
					  <td><?php echo $row['disease_type']; ?></td>
					  <td><?php echo $row['upload_date']; ?></td>
					  <td>View</td>
					</tr>
					<div id="myModal_<?php echo $row['id']; ?>" class="modal hide" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close btn_close_modal" data-dismiss="modal" style="margin:0;">&times;</button>
								<h4 class="modal-title">Prescription</h4>
							</div>
							<div class="modal-body">
							<img width="100%" src="admin/images/prescriptions/<?php echo htmlentities($row['prescription_image']);?>">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default btn_close_modal" data-dismiss="modal">Close</button>
							</div>
							</div>
						</div>
					</div>
					<?php } ?>
					</tbody>
					</table>
					
					<a id="btn_buy_prescription" class="btn btn-danger btn-lg" href="#" style="position:relative; bottom:10px; right:10px; padding:15px;width:500px"></a>
					
					<div id="myModalBuy" class="modal hide" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close btn_close_modal" data-dismiss="modal" style="margin:0;">&times;</button>
								<h4 class="modal-title">Buy Prescription</h4>
							</div>
							<div class="modal-body">
								<h5 class="summary"></h5>
								<form id="form_buy" method="post" action="order_prescription.php">
									<input type="hidden" id="prescription_id" name="prescription_id" value="">
                  <img src="https://www.logo.wine/a/logo/BKash/BKash-Icon2-Logo.wine.svg"
                      class="rounded float-left" alt="..." height="100px" width="100px" ;>
                  <input type="radio" name="paymethod" value="bkash" checked="checked"> Bkash

                  <img src="https://www.logo.wine/a/logo/Nagad/Nagad-Vertical-Logo.wine.svg" class="rounded" style="margin-left:20px;"
                      alt="..." height="100px" width="100px">
                  <input type="radio" name="paymethod" value="Nagad"> Nagad

                  <hr>

                  <img src="https://5.imimg.com/data5/NX/QH/SF/SELLER-78615388/cash-on-delivery-jpg-500x500.jpg"
                      class="rounded" alt="..." height="100px" width="100px">
                  <input type="radio" name="paymethod" value="Cash on Delivery"> COD

                  <!--<img src="https://cdn4.iconfinder.com/data/icons/money-filled-outline/64/money-colored-15-512.png" style="margin-left:20px;"
                      class="rounded" alt="..." height="100px" width="100px">
                  <input type="radio" name="paymethod" value="Your Point"> Your Point-->
                  <br>
                  <input type="submit" name="submit" class="btn btn-primary">
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default btn_close_modal" data-dismiss="modal">Close</button>
							</div>
							</div>
						</div>
					</div>
        </div>
        
      </div>
    </div>
  </section>


  <!-- Footer Start -->

  <?php include('includes/footer.php')?>

  <!-- Footer End -->

  <!--     Essential Scripts    -->
  <?php include('includes/scripts.php'); ?>
	<link rel="stylesheet" href="assets/js/jquery.bootgrid.min.css">
	<script src="assets/js/jquery.bootgrid.min.js"></script>
	<script>
	$(document).ready(function(){
		var no_of_prescription = 0;
		var prescription_price = 50; // per Prescription, // same entry at order_prescription.php
		
		var grid = $("#grid-basic").bootgrid({
			caseSensitive: false,
	    selection: true,
	    multiSelect: true,
	    rowSelect: true,
	    keepSelection: true,
	    formatters: {
        "link": function(column, row)
        {
        	return "<a class='btn_view_prescription' data-id='" + row.id + "' href=\"#\">view</a>";
        }
	    }
		}).on("loaded.rs.jquery.bootgrid", function()
		{
	    /* Executes after data is loaded and rendered */
	    grid.find(".btn_view_prescription").on("click", function(e)
	    {
	    	var modal = "#myModal_" + $(this).data("id");
	    	$(modal).show('slow');
        return false;
	    });
		}).on("selected.rs.jquery.bootgrid", function(e, rows)
		{
			//var row_id = rows[0].id;
		  //var selected_row = 'tr[data-row-id=' + row_id + ']';
		  //$(selected_row).css('background', '#C6FFDD');
		  no_of_prescription++;
		  if(no_of_prescription >= 1){
		  	$('#btn_buy_prescription').html('Buy Prescription (' + no_of_prescription + ' selected, Amount: ' + (no_of_prescription * prescription_price) + ' BDT)');
		  }
		  
		}).on("deselected.rs.jquery.bootgrid", function(e, rows)
		{
			//var row_id = rows[0].id;
		  //var selected_row = 'tr[data-row-id=' + row_id + ']';
		  //$(selected_row).css('background', '');
		  no_of_prescription--;
		  if(no_of_prescription >= 1){
		  	$('#btn_buy_prescription').html('Buy Prescription (' + no_of_prescription + ' selected, Amount: ' + (no_of_prescription * prescription_price) + ' BDT)');
		  }else{
		  	$('#btn_buy_prescription').html("");
		  }
		});
		
		$('.btn_close_modal').click(function(){
			$('.modal').hide();
		});
		
		$('#btn_buy_prescription').click(function(){
			if(no_of_prescription < 1){
				alert('Please select Prescription.');
				return false;
			}
			
			$('#myModalBuy .summary').html(no_of_prescription + ' Prescription Selected, Amount: ' + (no_of_prescription * prescription_price) + ' BDT');
			
			var rowIds = [];
	    $('#grid-basic .select-box').each(function(){
	    	if( $(this).is(':checked') && $(this).val() != 'all' ){
	    		 rowIds.push( $(this).val() );
	    	}
	    });
	    
			$('#myModalBuy #prescription_id').val( rowIds.join(",") );
			$('#myModalBuy').show('slow');
			return false;
		});
		
		$('#form_buy').submit(function(){
			var row_id = $('#prescription_id').val();
			if(!row_id){
				return false;
			}
			
		});
		
	});
	</script>
</body>

</html>