     <!DOCTYPE html>
     <html lang="en">

     <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="A fresh approach in facilities management">
        <meta name="author" content="Ashley Smith">

        <title>Spright.</title>

<!--    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/css/dataTables.bootstrap.css">-->
<!--    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.3/css/jquery.dataTables.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <link href="/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
        <link href="/css/sb-admin-2.css" rel="stylesheet">
        <link href="/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
        <link href="/css/select2.css" rel="stylesheet"/>
        <link href="/css/select2-bootstrap.css" rel="stylesheet"/>
        <link href="/css/ui.fancytree.min.css" rel="stylesheet" type="text/css">  
       <link href="/css/jquery.simplecolorpicker.css" rel="stylesheet">--> 
       <!-- <link href="/css/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet"> -->
       <link href="/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
       <link href="/css/lib.min.css" rel="stylesheet"> 
        <link href="/css/spright.css" rel="stylesheet"> 
        <link rel="shortcut icon" type="image/ico" href="/favicon.ico" />

        </head>

        <body>

            <div id="wrapper">


                <?php 


                if ($this->Session->read('Auth.User')){
                    echo $this->Element('navigation');
                }
                ?>

                <!-- Page Content -->

                <!-- /#page-wrapper -->


                <?php echo $this->fetch('content'); ?>


            </div>

            <?php //echo $this->AssetCompress->script('libs'); ?>
            <!-- /#wrapper -->


            <script src="/js/jquery-1.11.1.js"></script>
            <script src="/js/jquery-ui.js"></script>
            <script type="text/javascript" src="/js/jquery.validate.min.js"></script>
            <script src="/js/bootstrap.min.js"></script>
            <script src="/js/plugins/metisMenu/metisMenu.min.js"></script>
            <script src="/js/sb-admin-2.js"></script>
            <script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
            <script type="text/javascript" src="/js/bootstrap-growl.min.js" charset="UTF-8"></script>
            
            <script src="/js/bootbox.min.js"></script>
            <script src="/js/jquery.knob.js"></script>
            <script src="/js/jquery.ui.widget.js"></script>
            <script src="/js/jquery.iframe-transport.js"></script>
            <script src="/js/jquery.fileupload.js"></script>
            
            <script src="/js/select2.min.js"></script>
            <script src="/js/bootstrap-growl.min.js"></script>
            <script src="//cdn.datatables.net/1.10.3/js/jquery.dataTables.min.js"></script>
            <script src="/js/jquery.simplecolorpicker.js"></script>
            <script src="/js/jquery.fancytree-all.min.js" type="text/javascript"></script>
            <script src="/js/jquery.loadJSON.js" type="text/javascript"></script>
            <script src="/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
   
        
        <!-- Refer to lib.min.js for a full list of the open source libraries which Spright uses -->
      <!--   <script src="/js/lib.min.js"></script>   -->

        <!-- Spright. Modules -->
        <script src="/js/spright.validation.js"></script> 
        
        <script src="/js/spright.work.js?v=<?php echo rand() ?>"></script>
        <script src="/js/spright.admin.js"></script>
        <script src="/js/spright.asset.js"></script>
        <script src="/js/spright.js?v=<?php echo rand() ?>"></script>
            <style>


                ul.fancytree-container {
                  width: 90%;
                  height: 400px;
                  overflow: auto;
                  position: relative;
              }

              #questionsView{

                width: 90%;
                height: 400px;
                overflow: auto;
                position: relative;  
            }

            .modal.fade:not(.in).right .modal-dialog {
                -webkit-transform: translate3d(125%, 0, 0);
                transform: translate3d(125%, 0, 0);
            }
        </style>

    </body>

    </html>

