<h2>tufjhkSelect Student</h2>
<div class="container">
  <form action="/forms/select" method="post" onsubmit="return check();">
    <div>
  <label>Students by netID.</label>
  <select name="student_netID" id="student_netIDs">
    <option value="0">Please choose one</option>
    {% for student in current_user.student_netIDs %}
    <option value="{{student}}">{{student}} - Current Advisor</option>
    {% endfor %}
     {% for student in current_user.second_reader_netIDs %}
    <option value="{{student}}">{{student}} - Current Second Reader</option>
    {% endfor %}

    {% for student in current_user.student_requests %}
    <option value="{{student}}">{{student}} - Advisor Request Pending</option>
    {% endfor %}
    {% for student in current_user.second_reader_requests %}
    <option value="{{student}}">{{student}} - Second Reader Request Pending</option>
    {% endfor %}
     </select>
    </div>
    <input type="hidden" name="form_type" value="{{form_type}}" />
    <div>
      <input type="submit" value="Submit" />
    </div>
  </form>
</div>
<hr>

