
/*
  <!-- <script>
  $(function updateSortable() {
  $( "#sortable" ).sortable({ axis: "y" });
  /* $( "#sortable" ).disableSelection(); */
});
</script>

    <script>
    $(document).ready(function(){
        // function slideout(){
        //   setTimeout(function(){
        //     $("#current_set").slideUp("slow", function () {
        //     });
        //   }, 2000);}
        // // $("#current_set").hide();

        $(function() {
            $("#sortable").sortable({
                opacity: 0.8,
                cursor: 'move',
                start: function() {
                    // puts the old positions into array before sorting
                    // var old_position = $(this).sortable('toArray');
                    var old_position = $(this).sortable('serialize');
                    // alert(old_position);
                },
                update: function() {
                    // var new_position = $(this).sortable('toArray');
                    // alert(my_serialize(new_position));
                    // var new_position = $(this).sortable("serialize") + '&set_id=' + $("#set_id").val(); // + '&update=update';
                    // var new = $.param(new_position);
                    var new_position = my_serialize($(this).sortable('toArray')) + '&set_id=' + $("#set_id").val();
                    // alert(new_position);
                    $.post("http://localhost/songs/index.php/sets/update_order", new_position, function(theResponse){
                        /* alert(theResponse); */
                        // $("#current_set").html(theResponse);
                        // $("#current_set").slideDown('slow');
                        // slideout();
                    });
                }
            });
        });
    });
</script>

    <script>
    function my_serialize(array) {
        var output = "";
        for (var i = 0; i < array.length; i++) {
            if (i == 0) {
                output += i + "=" + array[i];
            }
            else {
                output += "&" + i + "=" + array[i];
            }
        }
        return output;
    }
</script>


    <script>
    // for removing a song from a set
    $(document).ready(function() {
        $("img.remove").click(function() {
            /* alert('button has been clicked'); */
            var position = $(this).attr('value');
            /* alert(value); */
            var set_id = $("#set_id").val();
            var query_params = "set_id=" + set_id + "&position=" + position;


            $.post("http://localhost/songs/index.php/sets/remove_from_set", query_params, function(theResponse) {
                /* alert(theResponse); */
                $("#current_set").html(theResponse);
                /* updateSortable(); */
            });
            /* $(this).parent().hide(); */
            /* alert(query_params); */
        });
    });
</script>

    <script>
    $(document).ready(function() {
        $('.song_submit_button').click(function(event) {
            event.preventDefault();
            var song_id = $(this).val();
            var set_id = $("#set_id").val();
            var query_params = "set_id=" + set_id + "&song_id=" + song_id;
            // alert(query_params);
            $.post("http://localhost/songs/index.php/sets/add_to_set", query_params, function(theResponse) {
                // alert(theResponse);
                $("#current_set").html(theResponse);
            });
            // alert(query_params);
        });
    });
</script> -->
    */
