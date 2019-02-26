{% extends "layouts/base.volt"%}

{% block content %}

<?php use Phalcon\Tag; ?>

<h2>Registrate haciendo uso de este formulario</h2>

<?php echo Tag::form("usuario/login"); ?>

 <label>nombre</label>
<input type="text" name="nombre">
<br>
<label>email</label>
<input type="text" name="email">
<br>
<label>contraseña</label>
<input type="password" name="password">
<br>

 <p>
    <?php echo Tag::submitButton("Registrarme") ?>
 </p>

</form>



<h1>Primer Usuario</h1>

{% if single %}
{{ single.id }}
{{ single.nombre }}
{{ single.email }}
<hr>
{% set first=single.projecto.getFirst().toArray() %}
{{ first['nombre'] }}
<hr>
{% else %}
{{ nothing }}
{% endif %}


<h1>Todos los usuarios</h1>
<hr>
{% for key, user in all %}
{{ user.id }}
{{ user.nombre }}
{{ user.email }}
{% endfor %}

{% endblock content %}


