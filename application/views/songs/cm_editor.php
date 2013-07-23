<?php echo $header ?>

<form action="<?php echo site_url('music/update_metadata'); ?>" class="form-inline" method="POST">
  <table class="table">
    <tr>
      <td>
        <label for="title" class="control-label">Title</label>
      </td>
      <td>
        <input type="text" name="title" value="<?php echo $song->title; ?>" />
      </td>
      <td>
        <label for="author" class="control-label">Composer</label>
      </td>
      <td>
        <input type="text" name="author" value="<?php echo $song->author; ?>" />
      </td>
      <td>
        <label for="producer" class="control-label">Producer</label>
      </td>
      <td>
        <input type="text" name="producer" value="<?php echo $song->producer; ?>" />
      </td>
    </tr>
    <tr>
      <td>
        <label for="year" class="control-label">Year</label>
      </td>
      <td>
        <input type="text" name="year" value="<?php echo $song->year; ?>" />
      </td>
      <td>
        <label for="ccli" class="control-label">CCLI #</label>
      </td>
      <td>
        <input type="text" name="ccli" value="<?php echo $song->ccli; ?>" />
      </td>
      <td>
        <label for="standard_key" class="control-label">Standard Key</label>
      </td>
      <td>
        <input type="text" name="standard_key" value="<?php echo $song->standard_key; ?>" />
      </td>
    </tr>
  </table>
  <input type="hidden" name="id" value="<?php echo $song->id; ?>" >
  <input type="submit" value="Update Metadata">
</form>

<!-- <form action="<?php echo site_url('music/codemirror'); ?>" method="POST" > -->
<form action="<?php echo build_uri(array('id'=>$song->id), 'music/codemirror'); ?>" method="POST" >
  <textarea id="code" name="code">
<?php echo $content ?>
  </textarea>
  <input type="submit" value="Save">
</form>

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
  editor.setSize(800,400);
</script>
