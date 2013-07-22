{% extends "base.html.twig" %}
{% block title %}Checkpoint Form{% endblock %}
{% block content %}
<h2>Query Form View</h2>

<h3>Summary</h3>
<p>Your query matched
  {% if forms|length != 1 %}
  {{ forms|length }} forms.</p>
{% else %}
{{ forms|length }} form.</p>
{% endif %}

<table border="1">
  <tr>
    <th><a href="query_results?{{ {'sort_by':'form_type'} | urlencode }}">Form Type:</a></th>
    <th><a href="query_results?{{ {'sort_by':'student_netID'} | urlencode }}">Student NetID:</a></th>
    <th><a href="query_results?{{ {'sort_by':'student_name'} | urlencode }}">Student Name:</a></th>
    <th><a href="query_results?{{ {'sort_by':'advisor_netID'} | urlencode }}">Advisor NetID:</a></th>
    <th><a href="query_results?{{ {'sort_by':'advisor_name'} | urlencode }}">Advisor Name:</a></th>
    <th>Link:</th>
    <th>Delete:</th>
  </tr>
  {% for form in forms %}
  <tr>
    <td>{{ form.form_type }}</td>
    <td>{{ form.student_netID }}</td>
    <td>{{ form.student_name }}</td>
    <td>{{ form.advisor_netID }}</td>
    <td>{{ form.advisor_name }}</td>
    <td><a href="query_view?{{ {'form_type':form.form_type, 'student_netID':form.student_netID} | urlencode}}">View complete result </a></td>
    <td><a href="delete?{{ {'form_type':form.form_type, 'student_netID':form.student_netID} | urlencode}}">delete form </a></td>
    <!-- <td><form action="/forms/form_delete?{{ {'form_type':form.form_type, 'student_netID':form.student_netID} | urlencode}}" method="get"> -->
    <!--     <input type="submit" value="Delete"> -->
    <!--   </form> -->
    </td>
  </tr>
  {% endfor %}
</table>
<br>

<hr>
{% endblock %}
