{% extends "base.html.twig" %}
{% block title %}Thesis and COS IW Forms{% endblock %}
{% block content %}
<h1>Form Delete Confirmation</h1>
<p>The <b>{{form_type}}</b> form of <b>{{student_netID}} has been deleted.</p>
<a href="/forms/query">View Forms</a>
{% endblock %}
