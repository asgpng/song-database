<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Demo</title>
    <style>
     a.test {
       font-weight: bold;
     }
    </style>

    <script src="/songs/static/js/jquery-2.0.3.min.js"></script>
    <script src="/songs/static/js/jquery.form.js"></script>

    <script>
     $(document).ready(function(){
       function slideout(){
         setTimeout(function(){
           $("#response").slideUp("slow", function () {
           });

         }, 2000);}

       $("#response").hide();
       $(function() {
         $("#list ul").sortable({ opacity: 0.8, cursor: 'move', update: function() {

           var order = $(this).sortable("serialize") + '&amp;update=update';
           $.post("updateList.php", order, function(theResponse){
             $("#response").html(theResponse);
             $("#response").slideDown('slow');
             slideout();
           });
         }
                                           });
       });

     });
    </script>



  </head>
  <body>
    <!-- <div id="newContent">
    <a href="http://jquery.com/">jQuery</a>

    <form id="test" name="testform">
    <input type="hidden" name="set_id" value="val">
    <input type="button" name="song_id" value="SONG NAME">
    <input type="submit" value="submit">
    </form>
    </div> -->
    <div id="list">

      <div id="response"> </div>
      <ul>
        <?php
        include("connect.php");
        $query  = "SELECT id, text FROM dragdrop ORDER BY listorder ASC";
        $result = mysql_query($query);
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
        {

          $id = stripslashes($row['id']);
          $text = stripslashes($row['text']);

        ?>
        <li id="arrayorder_<?php echo $id;?>"><?php echo $id;?> <?php echo $text;?>
          <div class="clear"></div>
        </li>
        <?php } ?>
      </ul>
    </div>
    <?php var_dump($_POST); ?>

  </body>
</html>