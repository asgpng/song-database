var base_url = '/~asg4/songs/index.php';

// editor windows after transpose
$(document).ready(function() {
  // alert('test');
  $('#transpose_menu li').click(function(event) {
    event.preventDefault();
    var action = $(this).text();
    var re = /.[0-9]/;
    var steps = action.match(re);
    var song_id = $('#song_id').val();
    var query_params = 'song_id=' + song_id + '&steps=' + steps;

    $.post(base_url + '/music/transpose', query_params, function(response) {
      $("#cm_editor").html(response);
    });
      return false;

  });
});



// function remove_song(position) {
//     var set_id = $("#set_id").val();
//     var query_params = "set_id=" + set_id + "&position=" + position;
//     $.post(base_url + '/sets/remove_from_set', query_params, function(theResponse) {
//         // alert(theResponse);
//             // $("#current_set").html(theResponse);

//     });
//     $(this).parent().remove();
//     update_order();
//     //     // alert(query_params);
//     // updateSortable();





//     return false;
// };


$(function() {
  $("#datepicker").datepicker( {
    dateFormat: $.datepicker.ISO_8601
  } );
});

function updateSortable() {
  $( "#sortable" ).sortable({ axis: "y" });
  $( "#sortable" ).disableSelection();
};

$(document).ready(function() {
  // switch order after move
  $(function update_order() {
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
        $.post(base_url + '/sets/update_order', new_position, function(theResponse){
          /* alert(theResponse); */
          // $("#current_set").html(theResponse);
          // $("#current_set").slideDown('slow');
          // slideout();
        });
      }
    });
  });

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
})

$(document).ready(function() {
  // for removing a song from a set
  $("img.remove").click(function(event) {
    event.preventDefault();
    // alert('button has been clicked');
    var position = $(this).attr('value');
    /* alert(value); */
    var set_id = $("#set_id").val();
    var query_params = "set_id=" + set_id + "&position=" + position;


    $.post(base_url + '/sets/remove_from_set', query_params, function(theResponse) {
      // alert(theResponse);
        $("#current_set").html(theResponse);
        updateSortable();
    });
    // update_order();
    // alert(query_params);
    $(this).parent().remove();

  });
})

$(document).ready(function() {
  // for adding a song to the set
  $('.song_submit_button').click(function(event) {
    event.preventDefault();
    var song_id = $(this).val();
    var set_id = $("#set_id").val();
    var song_name = $(this).attr('id');
    var song_count = $("#song_count").val();
    var query_params = "set_id=" + set_id + "&song_id=" + song_id;
    // alert(query_params);
    $.post(base_url + '/sets/add_to_set', query_params, function(theResponse) {
      // alert(theResponse);
      $("#current_set").html(theResponse);
updateSortable();
    });
    // var $li = $("<li class='ui-state-default'/>").text(song_name);

    // var $li = '<li class="ui-state-default" name="'
    //   + song_count + '" id="' + song_id
    //   + '"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><a href="'
    //   + base_url + '/music/codemirror/' + song_id + '">'
    //   + song_name + '</a>'
    //   + '<img value="' + song_count + '" class="remove" src="'
    //   + '/~asg4/songs/static/img/glyphicons_free/glyphicons/png/glyphicons_207_remove_2.png' + '" height="10" width="10" >'
    //   + '</li>';

    // name="<?php echo $count; ?>" id="<?php echo $song->song_id; ?>">
    //          <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
    //          <?php echo anchor('music/codemirror/'.$song->song_id, $song->title); ?>
    //          <img value="<?php echo $count; ?>" class="remove" src=<?php echo base_url('static/img/glyphicons_free/glyphicons/png/glyphicons_207_remove_2.png'); ?> height="10" width="10">
    //        </li>';



    // $("#sortable").append($li);
    // $("#sortable").sortable('refresh');
    // alert(query_params);
  });


});



// prepare the form when the DOM is ready
  /*$(document).ready(function() {
  var options = {
    // target:        '#song_tags',   // target element(s) to be updated with server response
    // beforeSubmit:  showRequest,  // pre-submit callback
    // success:       showResponse  // post-submit callback

    // other available options:
    //url:       url         // override for form's 'action' attribute
    //type:      type        // 'get' or 'post', override for form's 'method' attribute
    //dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
    //clearForm: true        // clear all form fields after successful submit
    //resetForm: true        // reset the form after successful submit

    // $.ajax options can be used here too, for example:
    //timeout:   3000
  };

  // bind form using 'ajaxForm'
  $('#form_song_data').ajaxForm(options);
  });*/

// song meta data form
$(document).ready(function() {
    $('#form_song_data').submit(function() { // catch the form's submit event
        $.ajax({ // create an AJAX call...
            data: $(this).serialize(), // get the form data
            type: 'POST',
            url: base_url + '/music/update_metadata',
            success: function(response) { // on success..
                $('#song_data_header').html(response); // update the DIV
            },
            error: function(response) {
                alert('fail');
            },
        });
        return false; // cancel original event to prevent form submitting
    });
});


// tags in editor view
$(document).ready(function() {
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

$(document).ready(function() {
    $('#form_tag_editor_big').submit(function() { // catch the form's submit event
        var song_id = $(this).attr('alt');
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

// save from song editor
$(document).ready(function() {
    $('#form_song_edit_save').click(function() { // catch the form's submit event
        var song_id = $('#song_id').val();
        // var code = $('#code').val();
        var code = editor.getValue();
        var query_params = 'song_id=' + song_id + '&code=' + code;
    $.post(base_url + '/music/update_code', query_params, function(response) {
      $("#cm_editor").html(response);
    });

/*        $.ajax({ // create an AJAX call...
            data: query_params,
            type: 'POST',
            url: base_url + '/music/update_code',
            success: function(response) { // on success..
                alert(response);
                $("#cm_editor").html(response);
            },
            error: function(response) {
                alert('fail');
            },
        });*/
        return false; // cancel original event to prevent form submitting
    });
});


// function song_edit() {
//     var code = $('#code').val();
//     var song_id = $('#song_id').val();
//     query_params = "code=" + code + "&song_id=" + song_id;
//     // alert(query_params);
//     $.post("http://localhost/songs/index.php/music/update_code", query_params, function(theResponse) {
//         alert(theResponse);
//         $("#current_set").html(theResponse);
//     });
//     // alert(query_params);

// }

// pre-submit callback
function showRequest(formData, jqForm, options) {
  // formData is an array; here we use $.param to convert it to a string to display it
  // but the form plugin does this for you automatically when it submits the data
  var queryString = $.param(formData);

  // jqForm is a jQuery object encapsulating the form element.  To access the
  // DOM element for the form do this:
  // var formElement = jqForm[0];

  alert('About to submit: \n\n' + queryString);

  // here we could return false to prevent the form from being submitted;
  // returning anything other than false will allow the form submit to continue
  return true;
}

// post-submit callback
function showResponse(responseText, statusText, xhr, $form)  {
  // for normal html responses, the first argument to the success callback
  // is the XMLHttpRequest object's responseText property

  // if the ajaxForm method was passed an Options Object with the dataType
  // property set to 'xml' then the first argument to the success callback
  // is the XMLHttpRequest object's responseXML property

  // if the ajaxForm method was passed an Options Object with the dataType
  // property set to 'json' then the first argument to the success callback
  // is the json data object returned by the server

  alert('status: ' + statusText + '\n\nresponseText: \n' + responseText +
        '\n\nThe output div should have already been updated with the responseText.');
}


// prepare the form when the DOM is ready
$(document).ready(function() {
  var options = {
    // target:        '#output2',   // target element(s) to be updated with server response
    // beforeSubmit:  showRequest,  // pre-submit callback
    // success:       showResponse  // post-submit callback

    // other available options:
    //url:       url         // override for form's 'action' attribute
    //type:      type        // 'get' or 'post', override for form's 'method' attribute
    //dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
    //clearForm: true        // clear all form fields after successful submit
    //resetForm: true        // reset the form after successful submit

    // $.ajax options can be used here too, for example:
    //timeout:   3000
  };

  // bind to the form's submit event
  $('#set-metadata').submit(function() {
    // inside event callbacks 'this' is the DOM element so we first
    // wrap it in a jQuery object and then invoke ajaxSubmit
    $(this).ajaxSubmit(options);

    // !!! Important !!!
    // always return false to prevent standard browser submit and page navigation
    return false;
  });
});
