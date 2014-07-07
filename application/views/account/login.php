<div class="col-md-offset-4 col-md-4">
{% for item in messages %}
<div class="alert alert-{{ item.type }}">{{ item.message }}</div>
{% endfor %}
<form method="post" class="form">
<p>
<div class="input-group">
	<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	<input type="text" id="identity" name="identity" placeholder="Identity" class="form-control"/>
</div>
</p>
<p>
<div class="input-group">
	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	<input type="password" id="password" name="password" placeholder="Password" class="form-control" />
</div>
</p>
<div class="checkbox">
	<label for="remember">
		<input type="checkbox" id="remember" name="remember" value="1"/> Remember
	</label>
</div>
<input type="submit" value="Login" class="btn btn-default"/>
</form>
</div>