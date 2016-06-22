<html>
	<head>
		<title>Contact | <?php include 'config.php'; echo TITLE?></title>
		<?php include 'ssl.php'; include 'material.php'; include 'materialmenu.php';?>
	</head>
	
	<body>
		<form action="doSend.php" method="POST">
		<h4>Message the Admins</h4>
		
     		 <div class="input-field col s6">
          <i class="material-icons prefix">invert_colors</i>
          <input id="subject" type="text" class="validate" name="subject" placeholder="Subject" required>
        </div>
        
        <br>
        <div class="input-field col s6">
         <i class="material-icons prefix">perm_identity</i>
          <input id="name" type="text" class="validate" name="name" placeholder="Your Name" required>
        </div>
        
        <br>
        <div class="input-field col s6">
        <i class="material-icons prefix">email</i>
          <input id="email" type="email" class="validate" name="email" placeholder="Your Email">
        </div>
        <br>
       <div class="input-field col s6">
        <i class="material-icons prefix">note_add</i>
          <input id="message" type="text" class="validate" name="message" placeholder="Your Message">
        </div>
        <br>
         <input type="submit" class="btn waves" value="Send Message">
         </form>
        <center><i>By contacting the admins of <?php include 'config.php'; echo TITLE?>, you conset to sharing the above information with them and recieving follow-up responses if they deem such action nessecardy and you provide them with a means of doing so (including email, text or otherwise)</i></center>
	</body>
</html>