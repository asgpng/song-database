
<script>
var base_url = '/~asg4/songs/index.php';

// editor windows after transpose
$(document).ready(function() {
  // alert('test');
  $('#transpose_menu li').click(function(event) {
    // alert('test');
    event.preventDefault();
    var action = $(this).text();
    var re = /.[0-9]/;
    var steps = action.match(re);
    var song_id = $('#song_id').val();
    var query_params = 'song_id=' + song_id + '&steps=' + steps;
    $.post(base_url + '/music/transpose', query_params, function(response) {
      $("#cm_editor").html(response);
     });
     return false;
  });
});
</script>

<script>
// save from song editor
$(document).ready(function() {
    $('#form_song_edit_save').click(function() { // catch the form's submit event
        var song_id = $('#song_id').val();
        var code = editor.getValue();
        var query_params = 'song_id=' + song_id + '&code=' + code;
                                                alert(code);
    $.post(base_url + '/music/update_code', query_params, function(response) {
      $("#cm_editor").html(response);
    });
    return false; // cancel original event to prevent form submitting
    });
});
</script>



<div class="cm-editor" id="cm_editor" style="padding-left: 0px;">
  <!-- <form action="<?php echo site_url('music/edit_song'); ?>" method="POST" > -->
  <form id="form_song_edit" name="edit" action="<?php echo site_url('music/edit_song/' . $song->id); ?>" method="POST" >
    <textarea id="code" name="code">
<?php echo $content ?>
    </textarea>
    <input type="hidden" name="song_id" id="song_id" value="<?php echo $song->id; ?>" >
    <div class="cm-buttons">
      <div class="btn-toolbar">
        <div class="btn-group">
          <a class="btn" type="submit" onclick="document.edit.submit(); return false;">Save</a>
        </div>
        <div class="btn-group">
          <!-- <a class="btn" type="submit" onclick="song_edit();">Save</a> -->
          <a class="btn" href="<?php echo site_url('music/view_html/' . $song->id); ?>">Print Preview</a>
        </div>
        <!-- Single button -->
        <div class="btn-group dropup" id="transpose_menu">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            Transpose <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu" id="transpose_menu">
            <li class="transpose_menu"><a href="+6">+6 Steps</a></li>
            <li><a value="+5" val="+5">+5 Steps</a></li>
            <li><a value="+4">+4 Steps</a></li>
            <li><a value="+3">+3 Steps</a></li>
            <li><a value="+2">+2 Steps</a></li>
            <li><a value="+1">+1 Steps</a></li>
            <li><a value="-1">-1 Steps</a></li>
            <li><a value="-2">-2 Steps</a></li>
            <li><a value="-3">-3 Steps</a></li>
            <li><a value="-4">-4 Steps</a></li>
            <li><a value="-5">-5 Steps</a></li>
            <!-- <li><button type="button">Test</button></li> -->
            <!-- <li class="divider"></li> -->
          </ul>
        </div>
      </div>
    </div>
  </form>
</div>
<script>
 // this needs to be here because it breaks above scripts if it isn't
 var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
   lineNumbers: true,
   matchBrackets: true,
   mode: "application/x-httpd-php",
   <!-- indentUnit: 4, -->
   <!-- indentWithTabs: false, -->
   enterMode: "keep",
   <!-- tabMode: "shift" -->
 });
 editor.setSize(700,440);
</script>
