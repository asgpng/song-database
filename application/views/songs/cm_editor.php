<div class="my_form">
<?php echo $header ?><br><br>

  <form action="<?php echo site_url('music/update_metadata'); ?>" class="form-horizontal" method="POST">
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
      <input type="text" name="year" value="<?php echo $song->year; ?>" />
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
      <input type="text" name="ccli" value="<?php echo $song->ccli; ?>" />
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
    <input type="hidden" name="id" value="<?php echo $song->id; ?>" >
  </form>
</div>
<div class="cm-editor">
  <!-- <form action="<?php echo site_url('music/codemirror'); ?>" method="POST" > -->
  <form name="edit" action="<?php echo site_url('music/codemirror/' . $song->id); ?>" method="POST" >
    <textarea id="code" name="code">
<?php echo $content ?>
    </textarea>
    <div class="cm-buttons">
      <div class="btn-toolbar">
        <div class="btn-group">
          <a class="btn" type="submit" onclick="document.edit.submit(); return false;">Save</a>
          <a class="btn" href="<?php echo '/songs/index.php/music/view_html/' . $song->id; ?>">View html</a>
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
    editor.setSize(600,440);
  </script>
