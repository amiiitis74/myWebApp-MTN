<form role="form" action="./account/login.php" method="post">
    <div class="form-group row">
        <label for="email" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
           <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="email@examlpe.com">
        </div>
    </div>
    <div class="form-group row">
        <label for="pass" class="col-sm-3 col-form-label">Password</label>
        <div class="col-sm-9">
          <input type="password" name="pass" class="form-control" id="pass" placeholder="Password">
        </div>
    </div>
    <div class="text-center">
         <input type="submit" value="Login" name="submit_login" class="btn btn-success">
    </div>
</form>