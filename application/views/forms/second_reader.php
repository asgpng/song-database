<?php echo form_open("forms/second_reader") ?>
<h2> Second Reader Form for IW</h2>
<div class="container">
  <div>
    <label>Student NetID:</label>
    <input type="text" name="student_netID" value="<?php echo set_value('student_netID') ?>" disabled/>
    <input type="hidden" name="student_netID_hidden" value="{{ current_user.netID }}"/>
  </div>
  <label>Second Reader's Name</label>
  <input type="text" name="sr_name" id="sr_name"/>
  <div>
    <label>Second Reader's NetID</label>
    <input type="text" name="sr_netID" id="sr_netID"/>
  </div>
  <div>
    <label>Second Reader's Department</label>
    <select name="sr_department" id="sr_department">
      <option value="ANT">Anthropology</option>
      <option value="ARC">Architecture</option>
      <option value="ART">Art and Archaeology</option>
      <option value="AST">Astrophysical Sciences</option>
      <option value="CBE">Chemical and Biological Engineering</option>
      <option value="CHE">Chemistry</option>
      <option value="CEE">Civil and Environmental Engineering</option>
      <option value="CLA">Classics</option>
      <option value="COM">Comparative Literature</option>
      <option value="COS" selected = "selected">Computer Science</option>
      <option value="EAS">East Asian Studies</option>
      <option value="EEB">Ecology and Evolutionary Biology</option>
      <option value="ECO">Economics</option>
      <option value="ELE">Electrical Engineering</option>
      <option value="ENG">English</option>
      <option value="FIT">French and Italian</option>
      <option value="GEO">Geosciences</option>
      <option value="GER">German</option>
      <option value="HIS">History</option>
      <option value="MAT">Mathematics</option>
      <option value="MAE">Mechanical and Aerospace Engineering</option>
      <option value="MOL">Molecular Biology</option>
      <option value="MUS">Music</option>
      <option value="NES">Near Eastern Studies</option>
      <option value="ORF">Operations Research and Financial Engineering</option>
      <option value="PHI">Philosophy</option>
      <option value="PHY">Physics</option>
      <option value="POL">Politics</option>
      <option value="PSY">Psychology</option>
      <option value="REL">Religion</option>
      <option value="SLA">Slavic Languages and Literatures</option>
      <option value="SOC">Sociology</option>
      <option value="SPO">Spanish and Portuguese</option>
      <option value="WWS">Woodrow Wilson School</option>
    </select>
  </div>
  <br>
  <div id="submit">
    <input type="submit" value="Submit">
  </div>
  <br>
</div>

</div>

<hr>
