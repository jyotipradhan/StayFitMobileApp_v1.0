<?php include "templates/include/header.php" ?>

<section data-role="page" id = "signupForm">

<div data-role="header" data-position="fixed">
  <h1> Stay Fit Logo </h1>
</div>
   

    <article data-role="content">
      <h1>Sign Up</h1>
      
      <form action="<?php echo APP_URL?>" method="post" data-transition="fade">
        <input type="hidden" name="action" value="signup" />
        <input type="hidden" name="signup" value="true" />

        <div data-role="fieldcontain">
          <input type="email" name="emailAddress" id="emailAddress" placeholder="Email address" required autofocus maxlength="50">
        </div>

        <div data-role="fieldcontain">
          <input type="password" name="password" id="password" placeholder="Password" required maxlength="30">
        </div>

        <div data-role="fieldcontain">
          <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Retype password" required maxlength="30">
        </div>

        <input type="submit" name="signup" value="Sign Up" />
        <a href="<?php echo APP_URL?>" data-role="button" data-rel="back" data-transition="slide" data-direction="reverse" data-theme="a">Cancel</a>

      </form>

    </article>

  
<div data-role="footer" data-position="fixed">
<h1>Copyrights &#169; 2014</h1>
</div><!--footer-->
</section>

<?php include "templates/include/footer.php" ?>

