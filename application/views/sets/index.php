<form action="<?php echo site_url('sets/new_set'); ?>" class="form-inline" method="POST">
  <table class="table table-striped">
    <tr>
      <th>Date</th>
      <th>Event</th>
      <th>Theme</th>
      <th>Leader</th>
    </tr>
    <?php foreach ($query->result() as $row): ?>
    <tr>
      <td>
        <?php echo anchor('sets/choose_songs/' . $row->id, $row->date); ?>
      </td>
      <td>
        <?php echo $row->event; ?>
      </td>
      <td>
        <?php echo $row->theme; ?>
      </td>
      <td>
        <?php echo $row->leader; ?>
      </td>
      <?php endforeach; ?>
    </tr>
    <tr>
      <td>
        <!-- <input type="text" name="date" placeholder="Date" /> -->
        <input class="input-small" type="text" name="date" id="datepicker" placeholder="Date" />
      </td>
      <td>
        <input class="input-small" type="text" name="event" placeholder="Event" />
      </td>
      <td>
        <input type="text" name="theme" placeholder="Theme" />
      </td>
    </tr>
  </table>
  <input type="submit" value="New Set">
</form>
