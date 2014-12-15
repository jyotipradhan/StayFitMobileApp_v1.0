<?php include "templates/include/header.php" ?>

  <div data-role="dialog" id="sendPasswordNotFound">

    <div data-role="header">
      <h1>Error</h1>
    </div>

    <div data-role="content">

      <div style="text-align: center;">
        <h2>Task Tango</h2>
        <p>We couldn't find your email address in the database. You can sign up using this email address if you like.</p>
      </div>

      <a href="<?php echo APP_URL?>?action=signup" data-role="button">Sign Up</a>
      <a href="<?php echo APP_URL?>?action=sendPassword" data-role="button">Try Another Address</a>

    </div>

  </div>

<?php include "templates/include/footer.php" ?>

