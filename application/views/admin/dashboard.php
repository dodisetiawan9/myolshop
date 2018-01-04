<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MyOlshop</title>

    <!-- Bootstrap -->
    <link href="<?= base_url(); ?>admin_assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url(); ?>admin_assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- datatables -->
    <link href="<?= base_url(); ?>admin_assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>admin_assets/css/responsive.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?= base_url(); ?>admin_assets/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">

           <?php echo $nav; ?>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            
          <?php echo $content; ?>

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url(); ?>admin_assets/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url(); ?>admin_assets/js/bootstrap.min.js"></script>
    <!-- datatables -->
    <script src="<?= base_url(); ?>admin_assets/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>admin_assets/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>admin_assets/js/dataTables.responsive.min.js"></script>

        
    <!-- Custom Theme Scripts -->
    <script src="<?= base_url(); ?>admin_assets/js/custom.min.js"></script>
    <script type="text/javascript">

       function addlist(obj, out)
         {
            var grup = obj.form[obj.name];
            var len = grup.length;
            var list = new Array();

            if(len > 1){
               for (var i = 0; i < len; i++) {
                  if(grup[i].checked){
                     list[list.length] = grup[i].value;
                  }
               }
            }

            else{
               if(grup.checked){
                     list[list.length] = grup.value ;
                  }
            }

            document.getElementById(out).value = list.join(', ');

            return;
         }


      $(document).ready(function(){
        $('#datatable').DataTable();
      });
    </script>
    <script type="text/javascript">
      $('.alert-message').alert().delay(3000).slideUp('slow');
    </script>
  </body>
</html>