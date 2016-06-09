<html>
<head></head>
<body> 
  <h1>Reset Password</h2>
  <form action="reset-password.php" method="post">
    Email address: <br/>
    <input type="text" name="email" /> <br/>
    Reset code: <br/>
    <input type="text" name="code" /> <br/>
    New password: <br/>
    <input type="password" name="password" /> <br/>
    New password (repeat): <br/>
    <input type="password" name="password-repeat" /> <br/>
    <input type="submit" name="submit" value="Change Password" />
  </form>
</body>
</html>