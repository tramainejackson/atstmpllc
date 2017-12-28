<!--- <div class="row navbar-fixed-top">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"></button>
	<div class="col-md-3 navbar navHeader adminNavColor">
		<ul class="nav navbar-nav">
			<li class=""><a href="index.php">ATSTMPLLC</a></li>
		</ul>
	</div>
	<nav class="col-md-9 navbar adminNavColor collapse navbar-collapse" id="myNavbar">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
				
			</ul>
			<ul class="nav navbar-nav navbar-right">
				
			</ul>
		</div>
	</nav>
</div> --->

<nav class="navbar navbar-inverse navbar-fixed-top adminNavColor">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php">ATSTMPLLC</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
		<li class=""><a href="bank.php">Banks</a></li>
        <li class=""><a href="transactions.php?view_transactions">Transactions</a></li>
		<li class=""><a href="users.php?edit_user">Users</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class=""><a href="logout.php">Logout <span class="glyphicon glyphicon-off"></span></a></li>
      </ul>
    </div>
  </div>
</nav>