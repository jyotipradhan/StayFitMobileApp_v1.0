<?php include "templates/include/header.php" ?>

 <!--Help Page-->
<section data-role="page" id = "help">
<div data-role="header" data-position="fixed">
  <h1> Stay Fit Logo </h1>
  <a href="#mypanel" class="ui-btn ui-btn-left ui-btn-icon-notext ui-icon-grid ui-corner-all"></a>
  <a href="<?php echo APP_URL?>?action=logout" data-iconpos="notext" data-icon="power" data-ajax="false">Log Out</a>  
</div> <!--header-->
<article data-role="content">
 <div role="main" class="ui-content" >         
 <ul data-role="listview" class="ui-listview-outer" data-inset="true">
 <li data-role="collapsible" data-iconpos="right" data-shadow="false" data-corners="false">
    <h2>About StayFit</h2>
    <ul data-role="listview" data-shadow="false" data-inset="true" data-corners="false" >
      <li>StayFit App is designed to inspire busy people to live a healthier and active life by performing small exercises. Your work schedule is our priority and we aim to provide a customizable time for you to exercise. Our reminders ensure that you live healthy by regular exercising. <br>

        According to preset reminders notify you to start working, all the while keeping in mind that the exercise are short and fit in your busy schedule. <br>

    We believe that  contributions as small as stretch or smile go a long way in your good health.</li>
      
    </ul>
  </li>

  <li data-role="collapsible" data-iconpos="right" data-shadow="false" data-corners="false">
    <h2>Usage</h2>
    <ul data-role="listview" data-shadow="false" data-inset="true" data-corners="false" >
      <li>You need to login to create an account. Once you are done with this, you get a wide choice range of the type of exercises to work. A step by step manual follows:
    Login : 
     For first time joining healthy people)Register using your email id and created password.for subsequent uses use  email id as the username and password
  Home : 
  A view of User Profile, ActivityLog and Help
ActivityLog: 
Maintains a log of how frequently you use the app
Notification Preference: 
The user chooses from morning or afternoon or evening.
Let’s Exercise 
gives us plenty of options to choose from exercising : 
  Stretching
  Breathing
  Walking
  Laughing
Help :
 On how to use the app
</li>
    </ul>
  </li>
  <li data-role="collapsible" data-iconpos="right" data-shadow="false" data-corners="false">
    <h2>Contributors</h2>
    <ul data-role="listview" data-shadow="false" data-inset="true" data-corners="false" >
     <li>Jyotirmayee Pradhan<br>
Sharad S. Shivmath<br>
Thiagaraja Gurusamy<br>
Yamini Meduru Spoorthy</li>
      
    </ul>
  </li>
 
  
 
</ul>
    </div><!-- /content -->
</article><!--content-->
<div data-role="footer" data-position="fixed">
<h1>Copyrights &#169; 2014</h1>
</div><!--footer-->
</section><!--page-->

<?php include "templates/include/footer.php" ?>

