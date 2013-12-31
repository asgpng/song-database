Current Set
<form id="form_current_set">
  <ul id="sortable">
    <?php $count=1; ?>
    <?php foreach ($current_songs->result() as $song): ?>
      <!-- <li class="ui-state-default" name="<?php echo $count; ?>" id="<?php echo $count . '_' . $song->song_id; ?>"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo anchor('music/edit_song/'.$song->song_id, $song->title); ?></li> -->
      <li class="ui-state-default" name="<?php echo $count; ?>" id="<?php echo $song->song_id; ?>">
        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
        <?php echo anchor('music/edit_song/'.$song->song_id, $song->title); ?>
        <img value="<?php echo $count; ?>" class="remove" src=<?php echo base_url('static/img/glyphicons_free/glyphicons/png/glyphicons_207_remove_2.png'); ?> height="10" width="10">
      </li>
      <?php $count++; ?>
    <?php endforeach; ?>
  </ul>
  <input type="hidden" name="set_id" value="<?php echo $set->id; ?>" >
</form>
