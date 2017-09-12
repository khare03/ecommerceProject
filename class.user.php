<?php

  class loggedInUser {
	public $email = NULL;
	public $pwd = NULL;

      //Logout
      public function userLogOut()
      {
          destroySession("ThisUser");
      }
}
?>