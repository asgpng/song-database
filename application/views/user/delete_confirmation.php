{% extends "base.html.twig" %}
{% block title %}Thesis and COS IW Forms{% endblock %}
{% block content %}
<h1>User Delete Confirmation</h1>
<p>User <b>{{netID}}</b> of type <b>{{user_type}}</b> has been deleted.</p>
<a href="/admin/users">View Users</a>
{% endblock %}
