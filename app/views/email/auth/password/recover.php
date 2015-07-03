<p>Haz click en el link de abajo para recuperar contrasena.</p>

{{ baseUrl }}{{ urlFor('password.reset') }}?email={{ user.email }}&identifier={{ identifier|url_encode }}

