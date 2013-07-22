<!-- <?php echo $header ?> -->

<form action="<?php echo site_url('songs/update_metadata'); ?>" class="form-inline">
  <table class="table">
    <tr>
      <td>
        <label for="title" class="control-label">Title</label>
      </td>
      <td>
        <input type="text" name="title" value="<?php echo $song->title; ?>" />
      </td>
      <td>
        <label for="author_lyrics" class="control-label">Lyrics Author</label>
      </td>
      <td>
        <input type="text" name="author_lyrics" value="<?php echo $song->author_lyrics; ?>" />
      </td>
      <td>
        <label for="author_music" class="control-label">Music Author</label>
      </td>
      <td>
        <input type="text" name="author_music" value="<?php echo $song->author_music; ?>" />
      </td>
    </tr>
    <tr>
      <td>
        <label for="copyright_producer" class="control-label">Producer</label>
      </td>
      <td>
        <input type="text" name="copyright_producer" value="<?php echo $song->copyright_producer; ?>" />
      </td>
      <td>
        <label for="copyright_year" class="control-label">Year</label>
      </td>
      <td>
        <input type="text" name="copyright_year" value="<?php echo $song->copyright_year; ?>" />
      </td>
      <td>
        <label for="ccli" class="control-label">CCLI #</label>
      </td>
      <td>
        <input type="text" name="ccli" value="<?php echo $song->ccli; ?>" />
      </td>
    </tr>
  </table>
  <input type="submit" value="Update Metadata">
</form>
<!-- <form action="<?php echo site_url('songs/update_metadata'); ?>" class="form-horizontal"> -->
<!--   <?php echo $header ?> -->
<!--   <div class="control-group"> -->
<!--     <label for="title" class="control-label">Title</label> -->
<!--     <div class="controls"> -->
<!--       <input type="text" name="title" value="<?php echo $song->title; ?>" /> -->
<!--     </div> -->
<!--   </div> -->
<!--   <div class="control-group"> -->
<!--     <label for="author_lyrics" class="control-label">Lyrics Author</label> -->
<!--     <div class="controls"> -->
<!--       <input type="text" name="author_lyrics" value="<?php echo $song->author_lyrics; ?>" /> -->
<!--     </div> -->
<!--   </div> -->
<!--   <div class="control-group"> -->
<!--     <label for="author_music" class="control-label">Music Author</label> -->
<!--     <div class="controls"> -->
<!--       <input type="text" name="author_music" value="<?php echo $song->author_music; ?>" /> -->
<!--     </div> -->
<!--   </div> -->
<!--   <div class="control-group"> -->
<!--     <label for="copyright_producer" class="control-label">Producer</label> -->
<!--     <div class="controls"> -->
<!--       <input type="text" name="copyright_producer" value="<?php echo $song->copyright_producer; ?>" /> -->
<!--     </div> -->
<!--   </div> -->
<!--   <div class="control-group"> -->
<!--     <label for="copyright_year" class="control-label">Year</label> -->
<!--     <div class="controls"> -->
<!--       <input type="text" name="copyright_year" value="<?php echo $song->copyright_year; ?>" /> -->
<!--     </div> -->
<!--   </div> -->
<!--   <div class="control-group"> -->
<!--     <label for="ccli" class="control-label">CCLI #</label> -->
<!--     <div class="controls"> -->
<!--       <input type="text" name="ccli" value="<?php echo $song->ccli; ?>" /> -->
<!--     </div> -->
<!--   </div> -->
<!--   <div class="controls"> -->
<!--     <input type="submit" value="Update Metadata"> -->
<!--   </div> -->
<!-- </form> -->

<form action="<?php echo site_url('songs/codemirror'); ?>" >
  <textarea id="code" name="code">
<?php echo $content ?>
  </textarea>
  <input type="submit" value="Submit">
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
