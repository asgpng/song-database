{% extends "base.html.twig" %}
{% block title %}User Query{% endblock %}
{% block content %}

<h1>User Entry for {{user.netID}}</h1>


<div class="container">
  
  <p>User type: {{user.user_type}}</p>
  <p>Forms submitted:</p>
  {% for form in forms %}
  <a href="/forms/view?form_type={{form.form_type}}&student_netID={{user.netID}}">{{form.form_type}}</a> <br>
  {% endfor %}
</div>
<hr>
{% endblock %}
