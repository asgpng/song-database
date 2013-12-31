<div class="form_song_data">
  <div class="song_data_header" id="song_data_header">
    <?php echo $header ?>
  </div>
  <div class="tags" id="song_tags">
    <form class="form-inline" action="<?php echo site_url('music/update_tags/'); ?>" method="POST" id="form_tag_editor">
      <b>Tags: </b>
      <?php echo $this->song_tag->string_tags_of_song($song->id); ?>
      <input type="hidden" name="song_id" value="<?php echo $song->id; ?>" >
      <input class="input-small" type="text" name="tag" placeholder="Add Tag"/>
    </form>
  </div>


  <br><br>

  <form action="<?php echo site_url('music/update_metadata/'); ?>" class="form-horizontal" method="POST" id="form_song_data">
    <div class="control-group">
      <label for="title" class="control-label">Title</label>
      <div class="controls">
        <input type="text" name="title" value="<?php echo $song->title; ?>" />
      </div>
    </div>
    <div class="control-group">
      <label for="author" class="control-label">Composer</label>
      <div class="controls">
        <input type="text" name="author" value="<?php echo $song->author; ?>" />
      </div>
    </div>
    <div class="control-group">
      <label for="year" class="control-label">Year</label>
      <div class="controls">
        <input type="text" name="year" value="<?php if ($song->year != 0): echo $song->year; endif; ?>" />
      </div>
    </div>
    <div class="control-group">
      <label for="producer" class="control-label">Producer</label>
      <div class="controls">
        <input type="text" name="producer" value="<?php echo $song->producer; ?>" />
      </div>
    </div>
    <div class="control-group">
      <label for="ccli" class="control-label">CCLI #</label>
      <div class="controls">
        <input type="text" name="ccli" value="<?php if ($song->ccli != 0): echo $song->ccli; endif; ?>" />
      </div>
    </div>
    <div class="control-group">
      <label for="standard_key" class="control-label">Standard Key</label>
      <div class="controls">
        <input type="text" name="standard_key" value="<?php echo $song->standard_key; ?>" />
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <input type="submit" value="Submit">
      </div>
    </div>
    <input type="hidden" name="song_id" value="<?php echo $song->id; ?>" >
  </form>
</div>

<div class="cm-editor" id="cm_editor">
  <!-- <form action="<?php echo site_url('music/edit_song'); ?>" method="POST" > -->
  <form id="form_song_edit" name="edit" action="<?php echo site_url('music/edit_song/' . $song->id); ?>" method="POST" >
    <textarea id="code" name="code">
<?php echo $content ?>
    </textarea>
    <input type="hidden" name="song_id" id="song_id" value="<?php echo $song->id; ?>" >
    <div class="cm-buttons">
      <div class="btn-toolbar">
        <div class="btn-group">
          <!--<a class="btn" type="submit" onclick="document.edit.submit(); return false;">Save</a>  -->
          <a id="form_song_edit_save" class="btn" type="submit">Save</a>
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
        </ul>
        </div>
      </div>
    </div>
  </form>
</div>


<script>
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
