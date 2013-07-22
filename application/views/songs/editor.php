<script>
saveFile = function() {
  alert('test');
    var contents = env.editor.getSession().getValue();

    $.post("write.php",
    {contents: contents },
    function() {
      // add error checking
      alert('successful save');
    }
  );
};

// Fake-Save, works from the editor and the command line.
canon.addCommand({
    name: "save",
    bindKey: {
        win: "Ctrl-S",
        mac: "Command-S",
        sender: "editor|cli"
    },
    exec: function() {
        saveFile();
    }
});
</script>
<pre id="editor">
Days of Elijah
Robin Mark © 1997 Daybreak Music CCLI #1537904
Order: V1, Cho, V2, Cho, Bridge 4x, Cho 2x, repeat last 2 lines

Intro: G /// C /// G /// C ///

Verse 1:
G                                   C
These are the days of Elijah,
        G               D                G
Declaring the word of the Lord:
          G                                       C
And these are the days of Your servant Moses,
   G                    D          G
Righteousness being restored.
          Bm                                       Em
And though these are days of great trial,
        Am                                 D      Dsus D(hold)
Of famine and darkness and sword,
           G                                 C
Still, we are the voice in the desert crying
        G               D               G
'Prepare ye the way of the Lord!'

Chorus
      (E)        (A)                             (D)                             (A)                        (E)
                    G                               C                                G                          D
Behold He comes riding on the clouds, shining like the sun at the trumpet call
                (A)                                 (D)                            (A)       (E)     (A)
                 G                                   C                              G         D       G   (C G C)
Lift your voice, it's the year of jubilee, and out of Zion's hill salvation comes

V2
These are the days of Ezekiel, the dry bones becoming as flesh;
And these are the days of Your servant David, Rebuilding a temple of praise.
These are the days of the harvest, The fields are as white in Your world,
And we are the laborers in Your vineyard, Declaring the word of the Lord!

Bridge
G                                              C
   There's no God like Jehovah.    There's no God like Jehovah!
G                                              D                                                        3 x
   There's no God like Jehovah.    There's no God like Jehovah!
4th time  G                                              C
                 There's no God like Jehovah.    There's no God like Jehovah!
              G                                              D // (to modulated chorus)
                 There's no God like Jehova-ah.


</pre>
<form action="<?php echo site_url('songs/edit'); ?>" onsubmit="saveFile();" method="post">
  <input type="submit" value="Submit" onclick="saveFile;">
</form>
<button onclick="saveFile();">Click</button>
<script src="/songs/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
var editor = ace.edit("editor");
editor.getSession().setMode("ace/mode/html");

</script>
