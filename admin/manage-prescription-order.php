<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

   
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include('include/links.php') ?>
        <title>Admin| Manage Prescription Orders</title>
    </head>

    <body>
        <?php include('include/header.php'); ?>

        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <?php include('include/sidebar.php'); ?>
                    <div class="span9">
                        <div class="content">
                            <div class="module">
                                <div class="module-head">
                                    <h3>Manage Prescription Orders</h3>
                                </div>
                                <div class="module-body table">
                                    <?php if (isset($_GET['del'])) { ?>
                                        <div class="alert alert-error">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
                                        </div>
                                    <?php } ?>

                                    <br />


                                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ID</th>
                                                <th>Company Id</th>
                                                <th>Prescription Id</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Hospital Name</th>
                                                <th>Doctor Name</th>
                                                <th>Disease Type</th>
                                                <th>Payment Method</th>
                                                <th>Order Date</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $query = mysqli_query($con, "select * from prescription_order");
                                            $cnt = 1;
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                    <td><?php echo htmlentities($row['id']); ?></td>
                                                    <td><?php echo htmlentities($row['company_id']); ?></td>
                                                    <td><?php echo htmlentities($row['prescription_id']); ?></td>
                                                    <td><?php echo htmlentities($row['quantity']); ?></td>
                                                    <td><?php echo htmlentities($row['amount']); ?></td>
                                                    <td><?php echo htmlentities($row['hospital']); ?></td>
                                                    <td><?php echo htmlentities($row['doctor']); ?></td>
                                                    <td><?php echo htmlentities($row['disease_type']); ?></td>
                                                    <td><?php echo htmlentities($row['payment_method']); ?></td>
                                                    <td><?php echo htmlentities($row['order_date']); ?></td>
                                                    
                                                </tr>
                                            <?php $cnt = $cnt + 1;
                                            } ?>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->



        <?php include('include/scripts.php') ?>

        <script>

        </script>
        <script>
            $(document).ready(function() {
                $('.datatable-1').dataTable();
                $('.dataTables_paginate').addClass("btn-group datatable-pagination");
                $('.dataTables_paginate > a').wrapInner('<span />');
                $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
                $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
            });
        </script>
    </body>
<?php } ?>