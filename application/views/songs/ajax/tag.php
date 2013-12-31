<script>$(document).ready(function() {
    $('#form_tag_editor').submit(function() { // catch the form's submit event
        $.ajax({ // create an AJAX call...
            data: $(this).serialize(), // get the form data
            type: 'POST',
            url: base_url + '/music/update_tags',
            success: function(response) { // on success..
                $('#song_tags').html(response); // update the DIV
            },
            error: function(response) {
                alert('fail');
            },
        });
        return false; // cancel original event to prevent form submitting
    });
});
</script>

<!-- style tag prevents awkward movement by padding twice -->
<div class="tags" id="song_tags" style="padding-right: 0px;">
  <form class="form-inline" action="<?php echo site_url('music/update_metadata/'); ?>" method="POST" id="form_tag_editor">
    <?php echo $this->song_tag->string_tags_of_song($song->id); ?>
    <input type="hidden" name="song_id" value="<?php echo $song->id; ?>" >
    <input class="input-small" type="text" name="tag" placeholder="Add Tag"/>
  </form>
</div>
