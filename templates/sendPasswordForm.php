<?php include "templates/include/header.php" ?>

  <div data-role="page" id="sendPasswordForm">

    <div data-role="header">
      <h1>Stay Fit Logo</h1>
    </div>

    <div data-role="content">

      <div style="text-align: center;">
        <h2>Get your password</h2>
        <p>Enter your email address below, and we'll send a new password to you.</p>
      </div>

      <form action="<?php echo APP_URL?>" method="post" data-transition="fade">
        <input type="hidden" name="action" value="sendPassword" />
        <input type="hidden" name="sendPassword" value="true" />

        <div data-role="fieldcontain">
          <input type="email" name="emailAddress" id="emailAddress" placeholder="Email address" required autofocus maxlength="50">
        </div>

        <input type="submit" name="sendPassword" value="Send Password" />
        <a href="<?php echo APP_URL?>" data-rel="back" data-role="button" data-theme="a" data-transition="slide" data-direction="reverse">Cancel</a>

      </form>

    </div>

  </div>

<?php include "templates/include/footer.php" ?>

