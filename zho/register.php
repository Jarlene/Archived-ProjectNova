<!DOCTYPE html>
<html lang="zh-cn">
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
                 <legend class="">欢迎来到Nova！请先注册.</legend>
               </div>
             <div class="control-group">

                   <!-- Text input-->
                   <label class="control-label" name="username" for="input01">用户名</label>
                   <div class="controls">
                     <input type="text" placeholder="" name="username" class="input-xlarge" required>
                     <p class="help-block" >
                       <font color=#0404B4>推荐使用email作为用户名注册哦.</font></p>
                   </div>
                 </div>

             <div class="control-group">

                   <!-- Text input-->
                   <label class="control-label" name="password" for="input01">密码</label>
                   <div class="controls">
                     <input type="password" name="password" class="input-xlarge" required>
                     <p class="help-block"></p>
                   </div>
                 </div>

              <div class="control-group">
                       <!-- Text input-->
                   <label class="control-label" name="conpass" for="input01">重复密码</label>
                   <div class="controls">
                     <input type="password" name="conpass" class="input-xlarge" required>
                     <p class="help-block"></p>
                   </div>
                 </div>

             <div class="control-group">

                   <!-- Text input-->
                   <label class="control-label" for="input01">语言喜好</label>
                   <div class="controls">
                     <select name="language">
                        <option value="eng">English</option>
                        <option value="zho">中文</option>
                        <option value="jpn">日本語</option>
                     </select>
                     <p class="help-block">
                       <font color=#0404B4>请选择一个您的常用语言.</font></p>
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
