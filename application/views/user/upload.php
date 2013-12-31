<script type="text/javascript">

function check() {

    var file = document.getElementById("fileUpload").value.split('\\')[2];
    var extension = file.split('.')[1];
    // var extension = "xls";
    var filename = file.split('.')[0];
    // alert('hello');

    if ((extension != "xls") || (extension != "csv"))
    if ((false) || (extension == "xls")) {
        alert("You did not select a valid file!");
	   return false;
    }
    else {
        document.getElementById("fileName").value = filename;
        document.getElementById("fileExt").value = extension;
	    return true;
    }
}
</script>
<h1>User Administration</h1>
<h2>User List Upload</h2>
<p>Use this feature to upload a user list with fields for netID and user_type. The uploaded file must be a <b>csv</b> file with one column for netIDs and one for user_type. This file can be updated to allow mass changes to the users.</p>

  <form action="{{upload_url}}?" method="post" onsubmit="return check();" enctype="multipart/form-data">
    <div><input type="file" id="fileUpload" name="uploadField"
                onchange="check();" /></div>
    <div><input type="submit" value="Upload" /></div>
    <input type="hidden" id="fileName"  name="filename" value="" />
    <input type="hidden" id="fileExt" name="extension" value="" />
    <input type="hidden" id="upload_type" name="upload_type" value="user_list" />
  </form>
