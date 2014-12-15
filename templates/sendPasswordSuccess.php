<?php include "templates/include/header.php" ?>

  <div data-role="dialog" id="sendPasswordSuccess">

    <div data-role="header">
      <h1>Password Sent</h1>
    </div>

    <div data-role="content">

      <div style="text-align: center;">
        <h2>Password Sent</h2>
        <p>Your new password has been sent to your email address.</p>
      </div>

      <a href="<?php echo APP_URL?>?action=login" data-role="button">OK</a>

    </div>

  </div>

<?php include "templates/include/footer.php" ?>

