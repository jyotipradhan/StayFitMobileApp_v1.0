<?php include "templates/include/header.php" ?>

  <div data-role="dialog" id="deleteCompleted">

    <div data-role="header">
      <h1>Delete Completed To-Dos</h1>
    </div>

    <div data-role="content">

      <div style="text-align: center;">
        <h2>Delete Completed To-Dos</h2>
        <p>Delete all completed to-dos?</p>
      </div>

      <form action="<?php echo APP_URL?>" method="post" data-transition="slide" data-direction="reverse">
        <input type="hidden" name="action" value="deleteCompleted" />
        <input type="hidden" name="confirm" value="true" />
        <input type="hidden" name="authToken" value="<?php echo $_SESSION['authToken']?>" />
        <input type="submit" name="delete" data-theme="f" value="Delete To-Dos" />
        <a href="<?php echo APP_URL?>?action=options" data-rel="back" data-role="button" data-theme="a">Cancel</a>
      </form>

    </div>

  </div>

<?php include "templates/include/footer.php" ?>

