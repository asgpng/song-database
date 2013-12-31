<div class="prose">
  <h1>Development Log</h1>
  <h4>10/31/13</h4>
  <p>
    Rolled out some UI updates, specifically regarding the set building. You can now drag songs to reorder them, which is simpler than the previous method of clicking buttons. Deleting is still buggy, but if all else fails, refresh your browser.
  </p>
  <p>
    In addition,
  </p>
  <h4>07/28/13</h4>
  <p>
    Welcome to this <b>worship music database website</b>. (If you have an idea for a better title, feel free to submit suggestions!) The goal of this site is to provide a centralized location for us as PEF worship leaders to select songs, keep track of when and how often we do songs, and view and edit sheet music.
  </p>
  <h3>Tutorial</h3>
  <p>
    Allow me to provide a short tutorial. The <b>'View Songs'</b> page contains the list of songs in the database, which can be sorted by title, author, producer, year, and CCLI number. Additionally, results can be filtered using the search box. The search feature looks at the title, author, producer, and text of each song and returns results in order of relevance. It should be helpful if we are looking for songs with a particular keyword in them. When the title of a song is clicked, you are redirected to a page where you can edit the metadata of the song as well as the text itself. In addition to editing the song, you can also view a print-ready version by clicking on 'View html'.
  </p>
  <p>
    The second main feature of the site currently is the <b>set builder</b>. There, you can add and remove songs to and from the set and reorder existing songs on the set. If a song is added to a set, its play count will be incremented and its date will be updated. This should help us keep track of how often we do songs and prevent us from repeating a song too often. Also, the sheer number of songs to choose from should encourage us to be creative in introducing new songs. Some of the songs currently in the database I couldn't really imagine doing at PEF, but there are also many good songs that have been overlooked simply because they weren't in the PEF folders.
  </p>
  <p>This is a work in progress, and I'm sure there are still bugs, but this is what alpha testing is for! Feel free to browse around and try out the features. If you find any bugs, or if you have ideas for new features, of if you simply have comments about the current user experience and functionality of the site, <?php echo safe_mailto('asg4@princeton.edu', 'please let me know.'); ?>
  </p>

  <h3>Ongoing Issues</h3>
  <p>
    Here's a short list of <b>current issues</b>, which you can keep in mind as you test things out:
  </p>
  <ul>
    <li>The html export feature may be a bit flaky. I attempted to parse the sheet music text by line and format things based on whether they were chords, lyrics, headings, credits, etc., but if you try to view the export of a file with 'unusual' sheet music, things may break.</li>
    <li>Also, since I converted the text from existing song files in Microsoft Word format, the spacing of chords and lyrics is off in some cases. A quick-and-dirty way to remedy this is to 'Replace All' in the browser text editor ('Ctrl+Shift+R') and replace three spaces with two. This ratio of conversion seems to come pretty close to correcting most problems, but the rest of the fine-tuning will need to be done by hand. In the end, it may not be that relevant, depending on whether or not we find the editing and html export features useful. One advantage of plaintext in the long run is that by using monospaced fonts in the sheet music, it is easy to change the formatting (font type, size, weight, etc.) without messing up the chord-lyric alignment.</li>
    <li>Songs with asterisks lack text. This is because, after adding the songs I had on my own computer, I went through the PEF folders and added entries for songs that weren't yet listed in the database. But I didn't get around to uploading the actual sheet music for all of those songs.</li>

    <li>The search may not behave quite as expcted because the search is set to ignore frequently used words in a 'stopwords' list. I disabled the reference to this list on my own development environment, but now that I'm using a shared hosting environment, I'm not sure if I have access to that setting. So don't be alarmed if you search for 'Enough' by Chris Tomlin and receive no results. If in doubt, use 'Ctrl+F'.</li>
    <ul>
</div>