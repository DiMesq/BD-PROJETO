<div class="container space-top">
  <div class="row row-content">
    <div class="col-xs-12 col-sm-9">
      <div class="col-sm-10 col-sm-offset-2" ><span id="alert_placeholder"></span></div>
      <form class="form-horizontal" id="login_input" action="login.php" method="POST">
        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"/>
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password"/>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-5 col-sm-offset-2">
            <button type="submit" class="btn btn-success">Login</button>
          </div>
        </div>
      </form>
    </div>
  </div> 
</div>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/login.js"></script>


