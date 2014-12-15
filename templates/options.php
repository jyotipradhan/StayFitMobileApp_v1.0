<?php include "templates/include/header.php" ?>

  <div data-role="page" id="options">

    <div data-role="header">
      <h1>Options</h1>
      <a href="<?php echo APP_URL?>?action=listTodos" data-icon="arrow-l">Back</a>
    </div>

    <div data-role="content">

      <a href="<?php echo APP_URL?>?action=deleteCompleted" data-role="button" data-transition="fade" data-prefetch>Delete Completed To-Dos</a>
      <a href="<?php echo APP_URL?>?action=changePassword" data-role="button" data-transition="slide" data-prefetch>Change Password</a>
      <a href="<?php echo APP_URL?>?action=logout" data-role="button" data-ajax="false">Log Out</a>

    </div>

  </div>

<?php include "templates/include/footer.php" ?>

