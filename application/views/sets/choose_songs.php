<!-- <script>
$(document).ready(function() {
updateSortable();
});
</script> -->


<style>
 #sortable { list-style-type: none; margin: 0; padding: 0; width: 300px; }
 #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 13px; height: 18px; }
 #sortable li span { position: absolute; margin-left: -1.3em; }
 #sortable li img { float: right; margin: 4px;}

</style>


<!-- set metadata form -->
<div id="form_set_metadata">
  <form id="set-metadata" action="<?php echo site_url('sets/update_set'); ?>" class="form-inline" method="POST">
    <label for="date" class="control-label">Date</label>
    <!-- <input type="text" name="date" id="datepicker" onchange="this.form.submit()" value="<?php echo $set->date; ?>" /> -->
    <input type="text" name="date" id="datepicker" value="<?php echo $set->date; ?>" />
    <label for="event" class="control-label">Event</label>
    <input type="text" name="event" value="<?php echo $set->event; ?>" />
    <label for="theme" class="control-label">Theme</label>
    <input type="text" name="theme" value="<?php echo $set->theme; ?>" />
    <label for="leader" class="control-label">Leader</label>
    <input type="text" name="leader" value="<?php echo $set->leader; ?>" />
    <input type="hidden" name="id" value="<?php echo $set->id; ?>" >
    <br>
    <br>
    <label for="members" class="control-label">Members</label>
    <input class="input-xxlarge" type="text" name="members" value="<?php echo $set->members; ?>" />
    <input type="hidden" name="id" value="<?php echo $set->id; ?>" >
    <input type="submit" value="Submit">
  </form>
</div>

<br>

<div id="current_set" data-spy="affix">
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
    <input type="hidden" id="song_count" name="song_count" value="<?php echo $count; ?>"
  </form>
</div>


<div id="songs">
  Showing <?php echo $songs->num_rows() ?> of <?php echo $number_songs ?> songs in the database.<br>
  <form id="form_song_options">
    <input type="hidden" name="set_id" id="set_id" value="<?php echo $set->id; ?>" >
    <table class="table table-condensed">
      <tr>
        <th style="width: 7%"></th>
        <th style="width: 23%"><?php echo anchor('sets/choose_songs/' . $set->id . '?order_by=title', 'Title') ?></th>
        <!--<th style="width: 40%"><?php echo anchor('sets/choose_songs/' . $set->id . '?order_by=author', 'Author') ?></th>  -->
        <th style="width: 40%">Themes</th>
        <th style="width: 5%">Key</th>
        <th style="width: 5%">Count</th>
        <th style="width: 10%">Last Done</th>
      </tr>
      <?php foreach ($songs->result() as $song): ?>
        <tr>
          <td>
            <!-- <input type="hidden" name="song_id" value="<?php echo $song->id; ?>" -->
            <button type="submit" formmethod="post" id="<?php echo $song->title; ?>" value="<?php echo $song->id; ?>" class="song_submit_button" formaction="<?php echo site_url('/sets/add_to_set/' . $song->id . '/' . $set->id); ?>">
              <!-- from http://www.iconfinder.com/icondetails/126585/128/arrow_back_previous_icon -->
              <img src="<?php echo base_url('static/img/left_arrow.png')?>" style="height: 10px; width: 10px;">
            </button>
            <!-- <i class="icon-arrow-left"></i> -->
          </td>
          <td><?php echo anchor('music/edit_song/'.$song->id, $song->title); ?></td>
          <!--<td><?php echo $song->author; ?></td>  -->
          <td><?php echo $this->song_tag->string_tags_of_song($song->id); ?>
          <td><?php echo $song->standard_key; ?></td>
          <td><?php echo $this->set_songs->song_count($song->id); ?></td>
          <td><?php echo $this->set_songs->last_done($song->id); ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </form>
</div>
