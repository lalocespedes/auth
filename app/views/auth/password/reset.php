

<form action="{{ urlFor('password.reset.post') }}?email={{ email}}&identifier={{ identifier|url_encode }}" method="post" autocomplet="off">

	<div>
		<label for="password">Password</label>
		<input type="password" name="password" id="password">
		{% if errors.has('password') %}{{ errors.first('password') }}{% endif %}
	</div>
	<div>
		<label for="password_confirm">Repetir password</label>
		<input type="password" name="password_confirm" id="password_confirm">
		{% if errors.has('password_confirm') %}{{ errors.first('password_confirm') }}{% endif %}

	</div>
	<div>
		<input type="submit" value="Change password">
	</div>

</form>