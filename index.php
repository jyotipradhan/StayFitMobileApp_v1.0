<?php

require( "config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
if ( !$action ) $action = isset( $_POST['action'] ) ? $_POST['action'] : "";

// If the user isn't logged in and they're trying to access a protected page,
// display the login form and exit

if ( !User::getLoggedInUser() && $action != "login" && $action != "logout" && $action != "signup" && $action != "sendPassword" ) {
  login();
  exit;
}

// Carry out the appropriate action
if ( !in_array( $action, array( 'login', 'logout', 'signup', 'sendPassword','stretching', 'newTodo', 'editTodo', 'deleteTodo', 'changeTodoStatus', 'options', 'deleteCompleted', 'changePassword','activity','help','excercise' ), true ) ) $action = 'listExercise';
$action();


/**
* Displays the login form
* If the form has been posted, logs the user in
*/

function login() {

  $results = array();
  $results['errorReturnAction'] = "login";
  $results['errorMessage'] = "Incorrect email address or password. Please try again.";

  if ( isset( $_POST['login'] ) ) {

    // User has posted the login form: attempt to log the user in

    if ( $user = User::getByEmailAddress( $_POST['emailAddress'] ) ) {

      if ( $user->checkPassword( $_POST['password'] ) ) {

        // Login successful: Create a session and redirect to the to-do list
        $user->createLoginSession();
        header( "Location: " . APP_URL );

      } else {

        // Login failed: display an error message to the user
        require( TEMPLATE_PATH . "/errorDialog.php" );
      }

    } else {

      // Login failed: display an error message to the user
      require( TEMPLATE_PATH . "/errorDialog.php" );
    }

  } else {

    // User has not posted the login form yet: display the form
    require( TEMPLATE_PATH . "/loginForm.php" );
  }
}


/**
* Logs the user out
*/

function logout() {
  User::destroyLoginSession();
  header( "Location: " . APP_URL );
}


/**
* Displays the signup form
* If the form has been posted, signs the user up
*/

function signup() {

  $results = array();
  $results['errorReturnAction'] = "signup";

  if ( isset( $_POST['signup'] ) ) {

    // User has posted the signup form: attempt to register the user
    $emailAddress = isset( $_POST['emailAddress'] ) ? $_POST['emailAddress'] : "";
    $password = isset( $_POST['password'] ) ? $_POST['password'] : "";
    $passwordConfirm = isset( $_POST['passwordConfirm'] ) ? $_POST['passwordConfirm'] : "";

    if ( !$emailAddress || !$password || !$passwordConfirm ) {
      $results['errorMessage'] = "Please fill in all the fields in the form.";
      require( TEMPLATE_PATH . "/errorDialog.php" );
      return;
    }

    if ( $password != $passwordConfirm ) {
      $results['errorMessage'] = "The two passwords you entered didn't match. Please try again.";
      require( TEMPLATE_PATH . "/errorDialog.php" );
      return;
    }

    if ( User::getByEmailAddress( $emailAddress ) ) {
      $results['errorMessage'] = "You've already signed up using that email address!";
      require( TEMPLATE_PATH . "/errorDialog.php" );
      return;
    }

    $user = new User( array( 'emailAddress' => $emailAddress, 'plaintextPassword' => $password ) );
    $user->encryptPassword();
    $user->insert();
    $user->createLoginSession();
    header( "Location: " . APP_URL );

  } else {

    // User has not posted the signup form yet: display the form
    require( TEMPLATE_PATH . "/signupForm.php" );
  }
}


/**
* Displays the "send password" form
* If the form has been posted, sends the user their new password
*/

function sendPassword() {

  $results = array();
  $results['errorReturnAction'] = "sendPassword";

  

  if ( isset( $_POST['sendPassword'] ) ) {

    // User has posted the form: attempt to send them a new password:

    $emailAddress = isset( $_POST['emailAddress'] ) ? $_POST['emailAddress'] : "";

    // Do some checks

    if ( !$emailAddress ) {
      $results['errorMessage'] = "Please enter your email address.";
      require( TEMPLATE_PATH . "/errorDialog.php" );
      return;
    }

    if ( !$user = User::getByEmailAddress( $emailAddress ) ) {
      require( TEMPLATE_PATH . "/sendPasswordNotFound.php" );
      return;
    }

    // Generate and send the password
    $user->generatePassword();
    $user->encryptPassword();
    $user->update();
    $user->sendPassword();

    require( TEMPLATE_PATH . "/sendPasswordSuccess.php" );

  } else {

    // User has not posted the form yet: display the form
    require( TEMPLATE_PATH . "/sendPasswordForm.php" );
  }
}


/**
* Displays the "new to-do" form
* If the form has been posted, saves the new to-do
*/

function newTodo() {

  $results = array();
  $results['pageTitle'] = "New To-Do";
  $results['formAction'] = "newTodo";

  if ( isset( $_POST['saveChanges'] ) ) {

    // User has posted the to-do edit form: save the new to-do
    if ( !checkAuthToken() ) return;
    $todo = new Todo ( $_POST );
    $todo->userId = User::getLoggedInUser()->id;
    $todo->createdTime = time();
    $todo->completed = false;
    $todo->insert();
    header( "Location: " . APP_URL . "?action=listTodos" );

  } elseif ( isset( $_POST['cancel'] ) ) {

    // User has canceled their edits: return to the to-do list
    header( "Location: " . APP_URL . "?action=listTodos" );
  } else {

    // User has not posted the to-do edit form yet: display the form
    $results['todo'] = new Todo;
    require( TEMPLATE_PATH . "/editTodo.php" );
  }
}


/**
* Displays the "edit to-do" form
* If the form has been posted, saves the changes
*/

function editTodo() {

  $results = array();
  $results['pageTitle'] = "Edit To-Do";
  $results['formAction'] = "editTodo";
  $results['errorReturnAction'] = "listTodos";
  $results['errorMessage'] = "To-do not found. Please try again.";

  if ( isset( $_POST['saveChanges'] ) ) {

    // User has posted the to-do edit form: save the changes
    if ( !checkAuthToken() ) return;

    if ( $todo = Todo::getById( (int)$_POST['todoId'] ) ) {
      if ( $todo->userId == User::getLoggedInUser()->id ) {
        $todo->__construct( $_POST );
        $todo->update();
        header( "Location: " . APP_URL . "?action=listTodos" );
      } else {
        require( TEMPLATE_PATH . "/errorDialog.php" );
      }
      
    } else {
      require( TEMPLATE_PATH . "/errorDialog.php" );
    }

  } elseif ( isset( $_POST['cancel'] ) ) {

    // User has canceled their edits: return to the to-do list
    header( "Location: " . APP_URL . "?action=listTodos" );

  } else {

    // User has not posted the to-do edit form yet: display the form
    if ( $results['todo'] = Todo::getById( (int)$_GET['todoId'] ) ) {
      if ( $results['todo']->userId == User::getLoggedInUser()->id ) {
        require( TEMPLATE_PATH . "/editTodo.php" );
      } else {
        require( TEMPLATE_PATH . "/errorDialog.php" );
      }

    } else {
      require( TEMPLATE_PATH . "/errorDialog.php" );
    }
  }
}


/**
* Displays the "delete to-do" confirm dialog
* If the user has confirmed deletion, delete the to-do
*/

function deleteTodo() {

  $results = array();
  $results['errorReturnAction'] = "listTodos";
  $results['errorMessage'] = "To-do not found. Please try again.";

  if ( isset( $_POST['confirm'] ) ) {

    // User has confirmed deletion: delete the to-do
    if ( !checkAuthToken() ) return;

    if ( $todo = Todo::getById( (int)$_POST['todoId'] ) ) {
      if ( $todo->userId == User::getLoggedInUser()->id ) {
        $todo->delete();
        header( "Location: " . APP_URL . "?action=listTodos" );
      } else {
        require( TEMPLATE_PATH . "/errorDialog.php" );
      }
      
    } else {
      require( TEMPLATE_PATH . "/errorDialog.php" );
    }

  } else {

    // User has not confirmed deletion yet: display the confirm dialog
    if ( $results['todo'] = Todo::getById( (int)$_GET['todoId'] ) ) {
      if ( $results['todo']->userId == User::getLoggedInUser()->id ) {
        require( TEMPLATE_PATH . "/deleteTodo.php" );
      } else {
        require( TEMPLATE_PATH . "/errorDialog.php" );
      }

    } else {
      require( TEMPLATE_PATH . "/errorDialog.php" );
    }
  }
}


/**
* Changes a specified to-do to either "completed" or "not completed"
*/

function changeTodoStatus() {

  if ( !checkAuthToken() ) return;
  $todoId = isset( $_POST['todoId'] ) ? (int)$_POST['todoId'] : ""; 
  $newStatus = isset( $_POST['newStatus'] ) ? $_POST['newStatus'] : ""; 

  if ( !$todoId || !$newStatus ) {
    echo "error";
    return;
  }

  if ( $todo = Todo::getById( (int)$_POST['todoId'] ) ) {
    if ( $todo->userId == User::getLoggedInUser()->id ) {
      $todo->completed = ( $newStatus == "true" ) ? 1 : 0;
      $todo->update();
      echo "success";
    } else {
      echo "error";
    }
    
  } else {
    echo "error";
  }
}


/**
* Displays the options page
*/

function options() {
  require( TEMPLATE_PATH . "/options.php" );
}

function activity() {
  require( TEMPLATE_PATH . "/activity.php" );
}


function exercise() {
  require( TEMPLATE_PATH . "/exercise.php" );
}


function help() {
  require( TEMPLATE_PATH . "/help.php" );
}

function stretching() {
  require( TEMPLATE_PATH . "/exeStretch.php" );
}
/**
* Displays the "delete completed to-dos" confirm dialog
* If the user has confirmed deletion, delete the to-dos
*/

function deleteCompleted() {

  if ( isset( $_POST['confirm'] ) ) {

    // User has confirmed deletion: delete the to-dos
    if ( !checkAuthToken() ) return;
    Todo::deleteCompletedForUser( User::getLoggedInUser() );
    header( "Location: " . APP_URL . "?action=listTodos" );

  } else {

    // User has not confirmed deletion yet: display the confirm dialog
    require( TEMPLATE_PATH . "/deleteCompleted.php" );
  }
}


/**
* Displays the "change password" form
* If the form has been posted, changes the user's password
*/

function changePassword() {

  $results = array();
  $results['errorReturnAction'] = "changePassword";

  if ( isset( $_POST['saveChanges'] ) ) {

    // User has posted the password edit form
    if ( !checkAuthToken() ) return;
    $currentPassword = isset( $_POST['currentPassword'] ) ? $_POST['currentPassword'] : "";
    $newPassword = isset( $_POST['newPassword'] ) ? $_POST['newPassword'] : "";
    $newPasswordConfirm = isset( $_POST['newPasswordConfirm'] ) ? $_POST['newPasswordConfirm'] : "";

    // Do some checks

    if ( !$currentPassword || !$newPassword || !$newPasswordConfirm ) {
      $results['errorMessage'] = "Please fill in all the fields in the form.";
      require( TEMPLATE_PATH . "/errorDialog.php" );
      return;
    }

    if ( $newPassword != $newPasswordConfirm ) {
      $results['errorMessage'] = "The two new passwords you entered didn't match. Please try again.";
      require( TEMPLATE_PATH . "/errorDialog.php" );
      return;
    }

    $user = User::getLoggedInUser();
    if ( !$user->checkPassword( $currentPassword ) ) {
      $results['errorMessage'] = "The current password you entered is incorrect. Please try again.";
      require( TEMPLATE_PATH . "/errorDialog.php" );
      return;
    }

    // All OK: change password
    $user->plaintextPassword = $newPassword;
    $user->encryptPassword();
    $user->update();
    require( TEMPLATE_PATH . "/changePasswordSuccess.php" );

  } else {

    // User has not posted the form yet: display the form
    require( TEMPLATE_PATH . "/changePasswordForm.php" );
  }
}


/**
* Lists the user's to-dos
*/

function listExercise() {
  $results = array();
  $results['todos'] = Todo::getListForUser( User::getLoggedInUser() );
  require( TEMPLATE_PATH . "/exercise.php" );
}


/**
* Checks the supplied anti-CSRF token is valid
* If it isn't, the user is logged out
*/

function checkAuthToken() {
  if ( !isset( $_POST['authToken'] ) || $_POST['authToken'] != $_SESSION['authToken'] ) {
    logout();
    return false;
  } else {
    return true;
  }
}

?>
