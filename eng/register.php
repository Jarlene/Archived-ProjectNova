<!DOCTYPE html>
<html lang="en-us">
<head>
		<meta charset="utf-8">
		<link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
</head>

<body>
	<div class="main">
				 <!-----start-main---->
				 <h1>Sign up</h1>

           <form class="form-horizontal" action="register.handle.php" method="post">
             <fieldset>
               <div id="legend" class="">
                 <legend class="">Welcome to nova! Please register first.</legend>
               </div>
             <div class="control-group">

                   <!-- Text input-->
                   <label class="control-label" name="username" for="input01">Username</label>
                   <div class="controls">
                     <input type="text" placeholder="" name="username" class="input-xlarge" required>
                     <p class="help-block" >
                       <font color=#0404B4>Nova regards your email account as your username.</font></p>
                   </div>
                 </div>

             <div class="control-group">

                   <!-- Text input-->
                   <label class="control-label" name="password" for="input01">Password</label>
                   <div class="controls">
                     <input type="password" name="password" class="input-xlarge" required>
                     <p class="help-block"></p>
                   </div>
                 </div>

              <div class="control-group">
                       <!-- Text input-->
                   <label class="control-label" name="conpass" for="input01">Confirm your password</label>
                   <div class="controls">
                     <input type="password" name="conpass" class="input-xlarge" required>
                     <p class="help-block"></p>
                   </div>
                 </div>

             <div class="control-group">

                   <!-- Text input-->
                   <label class="control-label" for="input01">Language</label>
                   <div class="controls">
                     <select name="language">
                        <option value="eng">English</option>
                        <option value="zho">Chinese</option>
                        <option value="jpn">Japanese</option>
                     </select>
                     <p class="help-block">
                       <font color=#0404B4>Please type in your preferred language.</font></p>
                   </div>
                 </div>
             </fieldset>

								 <div class="submit">
									<input type="submit" onclick="myFunction()" value="Create account" >
								</div>
							 </form>
		<!-----//end-main---->
		</div>

</body>
</html>
