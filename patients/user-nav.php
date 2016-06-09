    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./"><img src = "./img/crestar_linear_vvsm.jpg"/></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="./">Home</a></li>
            <li class="li-header"><a href="./results">Results</a></li>
            <li class="li-header"><a href="./billpay">Pay your bill</a></li>
            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Info <span class="caret"></span></a>
               <ul class="dropdown-menu">
                <li><a href="#">Indigent</a></li>
                <li><a href="#">About my Tests</a></li>
                <li><a href="#">Why Was I tested?</a></li>
              </ul> 
            </li>-->
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="li-header"><a href="./profile">My Profile</a></li>
            <li class="active"><a href="/logout">Log-Out<span class="sr-only">(current)</span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<script>
function idleLogout() {
    var t;
    window.onload = resetTimer;
    window.onmousemove = resetTimer;
    window.onmousedown = resetTimer; // catches touchscreen presses
    window.onclick = resetTimer;     // catches touchpad clicks
    window.onscroll = resetTimer;    // catches scrolling with arrow keys
    window.onkeypress = resetTimer;

    function logout() {
        window.location.href = 'logout.php';
    }

    function resetTimer() {
        clearTimeout(t);
        t = setTimeout(logout, 300000);  // time is in milliseconds
    }
}
idleLogout();
</script>