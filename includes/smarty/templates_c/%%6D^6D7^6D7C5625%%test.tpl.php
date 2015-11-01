<?php /* Smarty version 2.6.25-dev, created on 2015-10-13 07:28:41
         compiled from test.tpl */ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lesson 12</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/stylesheet.css">
    
    </head>
    <body style="padding: 5px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-offset-1 col-md-5">
                    <div id="panel1" class="panel panel-primary">
                        <div class="panel-heading pagination-centered">
                            <h4>
                                Панель 1
                            </h4>
                        </div>
                        <div class="panel-body">
                            <p> String 1</p>
                        </div>    
                    </div>  
                </div>    
                <div class="col-md-5">     
                    <div id="panel2" class="panel panel-primary">
                        <div class="panel-heading pagination-centered">
                            <h4>
                                Панель 2
                            </h4>
                        </div>
                        <div class="panel-body">
                            <p> String 2</p>
                            <p> String 3</p>
                        </div>    
                    </div>    
                </div>    


            </div>    
        </div> 
     
        <script>
           <?php echo '
                 alert(\'hi\');
               $(document).ready(
                       function() {
                           alert(\'hi2\');
                        //var h = $("#panel1").height(); 
                        //$("#panel2").height(h);
                    }
                     );
         
            '; ?>
                
        </script>
          
    </body>
</html>