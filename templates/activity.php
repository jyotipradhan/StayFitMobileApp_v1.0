<?php include "templates/include/header.php" ?>



<section data-role="page" id = "exercise-main">

<div data-role="header" data-position="fixed">
  <h1> Stay Fit Logo </h1>
  <a href="#mypanel" class="ui-btn ui-btn-left ui-btn-icon-notext ui-icon-grid ui-corner-all"></a>
  <a href="<?php echo APP_URL?>?action=logout" data-iconpos="notext" data-icon="power" data-ajax="false">Log Out</a>  
</div> <!--header-->
<article data-role="content">
   <input type="hidden" name="authToken" id="authToken" value="<?php echo $_SESSION['authToken']?>"/>
   <div role="main" class="ui-content" >

<div class="ui-corner-all custom-corners" data-position="fixed">
  <div class="ui-bar ui-bar-a">
    <h3>Time Log</h3>
  </div>
  <div class="ui-body ui-body-a">
    <p><!-- pie chart canvas element -->
        <canvas id="countries" width="300" height="300"></canvas>
        <script>
           
            // pie chart data
            var pieData = [
                {
                    value: 20,
                    color:"#878BB6"
                },
                {
                    value : 40,
                    color : "#4ACAB4"
                },
                {
                    value : 10,
                    color : "#FF8153"
                },
                {
                    value : 30,
                    color : "#FFEA88"
                }
            ];
            // pie chart options
            var pieOptions = {
                 segmentShowStroke : false,
                 animateScale : true
            }
            // get pie chart canvas
            var countries= document.getElementById("countries").getContext("2d");
            // draw pie chart
            new Chart(countries).Pie(pieData, pieOptions);
            
        </script></p>
  </div>
</div>


        
         </div><!-- /content -->
</article><!--content-->
<div data-role="footer" data-position="fixed">
<h1>Copyrights &#169; 2014</h1>
</div><!--footer-->
</section><!--page-->
<?php include "templates/include/footer.php" ?>