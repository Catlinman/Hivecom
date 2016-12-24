<!-- Main user login dialog -->
<p class="notice">
	By logging in you agree to the use of cookies on this site.
</p>
<div class="horizontal-line"></div>
<form name="loginform" action="/user/postlogin" method="post" target="_top" onsubmit="">
	<input type="text" name="username" maxlength="15" placeholder="Username" pattern="^([a-zA-Z]+\s?)*$" title="May only contain characters without multiple spaces inbetween">
	<input type="password" name="password" maxlength="128" placeholder="Password">
	<input type="submit" value="Sign in">
</form>
<p class="notice">
	<a href="/user/forgot">Forgot your password?</a>
</p>
<div class="horizontal-line"></div>
<p class="centered">
	<a href="/user/create">Don't have an account? Click here to create one.</a>
</p>
