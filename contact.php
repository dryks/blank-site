<?php
$errors = array();
$missing = array();
// check if the form has been submitted
if (isset($_POST['send'])) {
	require('_assets/includes/mailvars.inc.php');
  // email processing script
  $visitor_email = $_POST['email'];
  $subject = "Feedback from " . $companyName;
  // list expected fields
  $expected = array('name', 'phone', 'email', 'subject', 'comments');
  // set required fields
  $required = array('name', 'email', 'subject', 'comments');
  // create additional headers
  $headers = "From: " . $companyName ."<info@" . $domain . ">\r\n";
  $headers .= 'Content-Type: text/plain; charset=utf-8';
  require('_assets/includes/processmail.inc.php');
  if ($mailSent) {
	  $toCC = $visitor_email;
	  $subjectCC = "Feedback from " . $companyName;
	  $headersCC = "From: " . $companyName . "<DoNotReply@" . $domain . ">\r\n";
	  $headersCC .= 'Content-Type: text/plain; charset=utf-8';
	  $messageCC = $message;
	  $messageCC .= "This is an automated response, please do not respond to this email message as the address is not monitored.  I will be in contact with you as soon as I am able.\n";
	  $messageCC .= "-Staff\n";
	  $messageCC .= $companyName . "\n";
	  $messageCC .= "www." . $domain;
	  $mailSentCC = mail($toCC, $subjectCC, $messageCC, $headersCC );
	  if( $mailSentCC ) {
		  header('Location: thank-you.php');
		  exit();
	  }
  }
}
?>
<?php include '_assets/includes/header.inc.php' ?>
    <div class="col-md-8 col-md-offset-2">
      <h1>Contact</h1>
      <h4>Please be sure to include a <strong>valid email address</strong></h4>
      <hr />
      <form id="feedback" method="post" action="">
        <?php if (($_POST && $suspect) || ($_POST && isset($errors['mailfail']))) { ?>
        <p class="warning">Sorry, your mail could not be sent. Please try later.</p>
        <?php } elseif ($missing || $errors) { ?>
        <div class="alert alert-danger text-center">
          <h3 class="text-error text-center">Please fix the item(s) indicated</h3>
        </div>
        <?php } ?>
        <div class="form-group">
          <label>
          <?php 
            if ($missing && in_array('name', $missing)) { ?>
          <div class="alert alert-danger" role="alert">Please Enter Your Name</div>
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
          <div class="alert alert-danger" role="alert">Please enter your email address</div>
          <?php 
        } elseif (isset($errors['email'])) { 
        ?>
            <div class="alert alert-danger" role="alert">Invalid Email Address</div>
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
            <option value="option1"
      <?php
      if ($_POST && $_POST['subject'] == 'option1') {
        echo 'selected';
      } ?>>Option 1</option>
            <option value="option2"
      <?php
      if ($_POST && $_POST['subject'] == 'option2') {
        echo 'selected';
      } ?>>Option 2</option>
            <option value="option3"
      <?php
      if ($_POST && $_POST['subject'] == 'option3') {
        echo 'selected';
      } ?>>Option 3</option>
          </select>
        </div>
        <div class="form-group">
          <label>
          <?php 
      if ($missing && in_array('comments', $missing)) { ?>
          <div class="alert alert-danger" role="alert">Please enter your comments</div>
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