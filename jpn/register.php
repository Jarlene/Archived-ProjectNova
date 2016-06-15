<!DOCTYPE html>
<html lang="ja-jp">
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
				 <h1>サインアップ</h1>

           <form class="form-horizontal" action="register.handle.php" method="post">
             <fieldset>
               <div id="legend" class="">
                 <legend class="">ノヴァへようこそ！最初に登録してください.</legend>
               </div>
             <div class="control-group">

                   <!-- Text input-->
                   <label class="control-label" name="username" for="input01">ユーザー名</label>
                   <div class="controls">
                     <input type="text" placeholder="" name="username" class="input-xlarge" required>
                     <p class="help-block" >
                       <font color=#0404B4>ユーザてメールアドレスに使用を推奨。</font></p>
                   </div>
                 </div>

             <div class="control-group">

                   <!-- Text input-->
                   <label class="control-label" name="password" for="input01">パスワード</label>
                   <div class="controls">
                     <input type="password" name="password" class="input-xlarge" required>
                     <p class="help-block"></p>
                   </div>
                 </div>

              <div class="control-group">
                       <!-- Text input-->
                   <label class="control-label" name="conpass" for="input01">パスワードを繰り返します</label>
                   <div class="controls">
                     <input type="password" name="conpass" class="input-xlarge" required>
                     <p class="help-block"></p>
                   </div>
                 </div>

             <div class="control-group">

                   <!-- Text input-->
                   <label class="control-label" for="input01">言語設定</label>
                   <div class="controls">
                     <select name="language">
                        <option value="eng">English</option>
                        <option value="zho">中文</option>
                        <option value="jpn">日本語</option>
                     </select>
                     <p class="help-block">
                       <font color=#0404B4>ご希望の言語を選択してください.</font></p>
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
