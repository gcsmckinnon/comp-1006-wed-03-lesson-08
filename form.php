<form action="process.php" method="post" novalidate>
  <?php if (isset($id)): ?>
    <input type="hidden" name="id" value="">
  <?php endif ?>

  <div class="form-group">
    <label for="fname">First Name*:</label>
    <input type="text" name="fname" class="form-control" value="" required maxlength="20">
    <small class="form-text">Max length 20 characters</small>
  </div>

  <div class="form-group">
    <label for="lname">Last Name*:</label>
    <input type="text" name="lname" class="form-control" value="" required maxlength="20">
    <small class="form-text">Max length 20 characters</small>
  </div>

  <div class="form-group">
    <label for="email">Email*:</label>
    <input type="email" name="email" class="form-control" value="" required maxlength="30">
    <small class="form-text">Max length 30 characters</small>
  </div>

  <div class="form-group">
    <label for="age">Age:</label>
    <input type="number" name="age" class="form-control" value="" min="18" max="130">
    <small class="form-text">Age must be between 18 and 130</small>
  </div>

  <div class="form-group">
    <label for="url">Personal Page:</label>
    <input type="url" name="url" class="form-control" value="" maxlength="50">
    <small class="form-text">Max length 50 characters</small>
  </div>

  <div class="form-group">
    <button class="btn btn-large btn-primary">Submit</button>
  </div>
</form>