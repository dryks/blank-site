<?php include '_assets/includes/header.inc.php' ?>
    <div class="col-md-8 col-md-offset-2">
      <h1>Contact</h1>
      <h4>Please be sure to include a <strong>valid email address</strong></h4>
      <hr />
      <form id="feedback" method="post" action="">
        <?php if (($_POST && $suspect) || ($_POST && isset($errors['mailfail']))) { ?>
        <p class="warning">Sorry, your mail could not be sent. Please try later.</p>
        <?php } elseif ($missing || $errors) { ?>
        <h3 class="text-error text-center">Please fix the item(s) indicated</h3>
        <?php } ?>
          <div class="form-group">
            <label>
              <?php 
								if ($missing && in_array('name', $missing)) { ?>
              	<span class="text-error">Please enter your name</span>
              <?php 
								} else {
							?>
              Name:
              <?php 
								} 
							?>
            </label>
            <input name="name" id="name" type="text" class="form-control" placeholder="Name *Required*">
          </div>
          <div class="form-group">
            <label>Phone Number</label>
            <input name="phone" id="phone" type="tel" class="form-control" placeholder="Phone *Optional*">
         	</div>
          <div class="form-group">
            <label>
              <?php 
						if ($missing && in_array('email', $missing)) { 
						?>
              <span class="text-error">Please enter your email address</span>
              <?php 
						} elseif (isset($errors['email'])) { 
						?>
                <span class="text-warning">Invalid email address</span>
                <?php 
						} else { 
						?>
                Email Address:
                <?php 
						} 
						?>
            </label>
            <input name="email" id="email" type="text" class="form-control" placeholder="Email Address *Required*">
          </div>
          <div class="form-group">
            <label>Subject</label>
            <select id="subject" name="subject" class="form-control">
              <option value="na">Choose one:</option>
              <option value="btcsales"
					<?php
					if ($_POST && $_POST['subject'] == 'btcsales') {
					  echo 'selected';
					} ?>>BTC Sales</option>
              <option value="merchant-info"
					<?php
					if ($_POST && $_POST['subject'] == 'merchant-info') {
					  echo 'selected';
					} ?>>Merchant Information</option>
              <option value="feedback"
					<?php
					if ($_POST && $_POST['subject'] == 'feedback') {
					  echo 'selected';
					} ?>>Feedback</option>
            </select>
          </div>
          <div class="form-group">
            <label>
              <?php 
					if ($missing && in_array('comments', $missing)) { ?>
              <span class="text-error">Please enter your comments</span>
              <?php 
					} else { 
					?>
              Message:
              <?php
					}
					?>
            </label>
            <textarea name="comments" id="comments" class="form-control" rows="10" placeholder="Please enter your comments here..."></textarea>
          </div>
          <button type="submit" name="send" id="send" class="btn btn-inverse pull-right">Send</button>
      </form>
    </div>
    <?php include '_assets/includes/footer.inc.php' ?>
<!-- Page Specific JS --> 

<!-- End Page Specific JS -->
</body>
</html>