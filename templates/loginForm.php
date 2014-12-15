<?php include "templates/include/header.php" ?>

<section data-role="page" id="loginForm">

<div data-role="header" data-position="fixed">
<h1> Stay Fit Logo </h1>
<!--<a href="#mypanel" class="ui-btn ui-btn-left ui-btn-icon-notext ui-icon-grid ui-corner-all"></a>-->
<!--<a href="#navpanel" data-role="button" data-icon="bars" data-iconpos="notext" data-dismissible="true">Menu</a>-->
<!--<a href="#logout" data-icon="power" data-iconpos="notext">Logout</a>-->
</div> <!--header-->

    <article data-role="content">
        <div role="main" class="ui-content">
        <h2 class="mc-text-center">Welcome!</h2>
      <h3>Sign In</h3>

        <form action="<?php echo APP_URL?>" method="post" data-transition="fade">
        <input type="hidden" name="action" value="login" />
        <input type="hidden" name="login" value="true" />

        <div data-role="fieldcontain">
          <label for="emailAddress">Email Address</label>
          <input type="email" name="emailAddress" id="emailAddress" placeholder="Email address" required autofocus maxlength="50">
        </div>

        <div data-role="fieldcontain">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" placeholder="Password" required maxlength="30">
        </div>

        <input type="submit" name="login" value="Login" />
        <a href="<?php echo APP_URL?>?action=signup" data-role="button" data-transition="slide">Sign Up</a>
        <a href="<?php echo APP_URL?>?action=sendPassword" data-role="button" data-transition="slide">Forgot Your Password?</a>

      </form>
    </div>
    </article><!--content-->
<div data-role="footer" data-position="fixed">
<h1>Copyrights &#169; 2014</h1>
</div><!--footer-->
</section><!--page-->

<?php include "templates/include/footer.php" ?>

