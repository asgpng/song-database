# -*- coding: utf-8 -*-
# need to clasify each line

# OOP for chords, lines?

# TODO: robust checking, add exceptions

import re, sys, time, os

class UnfinishedParse(Exception):
    pass

class InvalidMeta(Exception):
    pass

def transpose(chord, steps):
    """Transpose a given chord a given number of steps.
    Returns : transposed chord
    """
    try:
        index = chords.index(chord)
    except ValueError:
        return "Input must be valid note."
    if index + steps >= 12:
        return chords[index+steps-12]
    elif index + steps < 0:
        return chords[index+steps+12]
    else:
        return chords[index+steps]

def is_date(item):
    if re.search('^[1|2]\d{3}$', item) != None:
        return True
    return False

def is_chord(line):
    """Check if line contains chords.
    Returns : boolean
    """
    test = re.split('\W|\d', line)
    chords = ['A', 'Bb', 'B', 'C', 'C#', 'D', 'Eb', 'E', 'F', 'F#', 'G', 'G#']
    i = 0
    # while i < len(test):
    for chord in test:
        if chord != '':
            # chord = test[i]
            # chords should have following properties (eventually check)
            if chord[0] not in chords:
                return False
            if len(chord) > 1 and chord[1:].lower() not in ['min', 'dim', 'sus', 'maj', 'm', 'b']:
                return False
            # most chords would be less than 6 characters long
            if len(chord) > 6:
                return False
        # except IndexError:
        #     print IndexError, chord
        #     continue

    return True

def is_blank(line):
    """Check if line is blank
    Returns : boolean
    """
    test = split(line)
    for elem in test:
        if elem != '':
            return False
    return True

def is_lyric(line):
    """Check if line contains lyrics.
    Currently not used, could be further implemented, i.e. comes after chords
    Returns : boolean
    """
    test = split(line)
    return True

def is_xml_line(line):
    """Check if line is a complete xml line i.e. <foo>bar</foo>
    Returns : boolean
    """
    # print line
    if '<' in line and '>' in line and '/' in line:
        return True
    return False

def is_xml(line):
    """Check if line contains xml
    Returns : boolean
    """
    if '<' in line and '>' in line:
        return True
    return False

def get_xml_type(line):
    """Get the xml type of an xml line by returning the first element which is
    not empty and which appears at least twice.
    Returns : xml type (string)
    """
    elems = split(line)
    for elem in elems:
        if elem != '' and elems.count(elem) >= 2:
            return elem

def get_xml_value(line):
    """Get the xml value of an xml line by returning everything that is not xml
    Returns : xml value (string)
    """
    elems = split(line)
    value = ''
    xml_tag_found = False
    i = 0
    tag = get_xml_type(line)
    for elem in elems:
        if elem != '' and elem != tag:
            value += elem + ' '
    return value

def get_heading(line):
    """Parse line to find heading, if it exists
    Returns : heading (string), or None
    """
    head = re.split('[\d\W]', line.lower())
    # print head, "head"
    # head = split(line.lower())
    # parse [verse] number, if existing:
    number = ""
    numbers = re.split('\D', line)
    for n in numbers:
        if n != "":
            number = n
    if 'intro' in head:
        return 'intro'
    if 'verse' in head:
        return 'verse ' + str(number)
    if 'pre chorus' in line.lower():
        return 'pre chorus ' + str(number)
    if 'chorus' in head:
        return 'chorus'
    if 'bridge' in head:
        return 'bridge'
    if 'tag' in head:
        return 'tag'
    if 'refrain' in head:
        return 'refrain'
    if 'order' in head:
        return 'order'
    if 'ending' in head:
        return 'ending'
    # if none of these, try single letters
    if 'v' in head:
        return 'verse ' + str(number)
    # if 'c' in head:
    #     return 'chorus'
    if 'b' in head:
        return 'bridge'
    if 'r' in head:
        return 'refrain'
    return None

def capitalize_first(word):
    """Capitalize first letter of word
    Returns : capitalized word
    """
    return word[0].upper() + word[1:]

def split(line):
    """Use regex to split into list of data (chords, lyrics, etc.)
    Returns : list
    """
    return re.split('\W+', line)

def split_chars(line):
    """Split line into list of characters
    Returns : list
    """
    chars = []
    for char in line:
        chars.append(char)
    return chars

# return list of lines
def read_file(file_name):
    """Read in file and produce list of lines
    Returns : list of lines
    """
    fin = open(file_name, 'r')
    lines = []
    for line in fin:
        lines.append(sanitize(line))
        # print line
    return lines

def process_upload(lines):
    title = lines[0]
    try:
        meta = parse_credits(lines[1])
    except UnboundLocalError:
        return 'Unable to parse credits line.'
    print title
    print meta['author']
    print meta['producer']
    print meta['date']
    print meta['ccli']

def get_title(lines):
    return lines[0]

def get_author(lines):
    try:
        return parse_credits(lines[1])['author']
    except KeyError:
        return ''

def get_producer(lines):
    try:
        return parse_credits(lines[1])['producer']
    except KeyError:
        return ''

def get_date(lines):
    try:
        return parse_credits(lines[1])['date']
    except KeyError:
        return ''

def get_ccli(lines):
    try:
        return parse_credits(lines[1])['ccli']
    except KeyError:
        return ''

def get_text(lines):
    return '\n'.join(lines[2:])

def get_html(lines):
    return html_export(lines)

credits = "Vicky Beeching © 2001 UK/Eire CCLI # 3447521"
def parse_credits(credits):
    """Parse credits (usually second line of a song)
    to identify relevant information.
    Returns : list of keys and values
    """
    line = re.split("[\s\#\©]", credits)
    # if is_blank(credits):
    #     return 'BLANK'
    try:
        for item_index, item in enumerate(line):
            # this could also match some ccli numbers
            if is_date(item):
                date = item
                author = ' '.join(line[:line.index(item)])
            if item.lower() == 'ccli':
                if line[item_index+1] == '':
                    ccli = line[item_index+2]
                else:
                    ccli = line[item_index+1]
                producer = ' '.join(line[line.index(date)+1:line.index(item)])
            # print author, producer, date, ccli
        return {'author':author, 'producer':producer, 'date':date, 'ccli':ccli}
    except UnboundLocalError:
        # most likely CCLI # is missing
        try:
            for item_index, item in enumerate(line):
                # this could also match some ccli numbers
                if is_date(item):
                    date = item
                    author = ' '.join(line[:line.index(item)])
                    producer = ' '.join(line[line.index(date)+1:])
            return {'author':author, 'producer':producer, 'date':date}
        # just return everything as author, can be fixed manually
        except UnboundLocalError:
            return {'author': ' '.join(line).strip()}
    #     raise InvalidMeta


def classify_song(lines):
    """Debugging tool parses song and classifies each line
    Returns : list of lines and their type
    """
    out_lines = []
    i = 2
    # assuming title and credits on all songs
    out_lines.append(['title', lines[0]])
    out_lines.append(['credits', lines[1]])
    while i < len(lines):
        line = lines[i]
        if is_xml_line(line):
            out_lines.append([get_xml_type(line), get_xml_value(line)])
        if is_xml(line):
            pass
        elif is_blank(line):
            line_type = 'blank'
            out_lines.append([line_type, line])
        elif is_chord(line):
            line_type = 'chords'
            out_lines.append([line_type, line])
        elif get_heading(line) != None:
            line_type = get_heading(line)
            out_lines.append(["heading", line_type])
        else: # default
            line_type = 'lyrics'
            out_lines.append([line_type, line])
        i += 1
    return out_lines

def html_head(css_file = '../style.css'):
    """Print html head
    Returns : html
    """
    return """
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="%s">
</head>
<body>\n""" % css_file

def html_foot():
    """Print html foot
    Returns : html
    """
    return """
</body>
</html>"""

def nbsp(text):
    return re.sub('\s', '&nbsp;', text)

def sanitize(line):
    """Replace problematic characters with suitable substitutes
    Returns : string
    """
    line = re.sub('\’', "'", line)
    line = re.sub('\xef\xbb\xbf', "", line)
    return  line

def chord_split(chords):
    list = re.split('\s', chords)
    chord_list = []
    for i in list:
        if i != '':
            chord_list.append(i)
    return chord_list

def chord_lyric_split(chords, lyrics, context=''):
    """Take line of chords and line of lyrics and combine them into
    span intput for html display.
    Returns : html with <span> tags
    """
    i = 0
    j = 0
    k = 0
    l = 0

    chord_list = chord_split(chords) # array of chords
    output = ""
    while k < len(chord_list):
    # for chord in chord_list:
        chord = chord_list[k]
        i = chords.find(chord, l) # index of chord location
        # if i == j:
        #     i += 1
        if i > len(lyrics): # add extra chord(s)
            output += nbsp(lyrics[j:])
            output += '  '
            output += '<span ' + context + '="'
            output += chord + '">'
            output += '&nbsp;</span>'
            break
        else:
            if i-1 > 0:
                output += nbsp(lyrics[j:i])   # will this work for leading chords?
                output += '<span ' + context + '="'
                output += chord + '">'
                output += nbsp(lyrics[i])
                output += '</span>'
                # output += lyrics[i]
            else: # leading chord
                output += '<span ' + context + '="'
                output += chord + '">'
                output += ''
                output += '</span>'
                output += nbsp(lyrics[i])
            # print lyrics[j:i]
            # print j, i, chord
            j = i+1 #len(chord)
            l = i + len(chord)
            k += 1
    if len(lyrics) > i:
        output += lyrics[i+1:]
    output += '\n<br>\n'
    # output = re.sub('\s', '&nbsp;', output)
    return output

def chord_lyric_table(html_chords, html_lyrics):
    """Deprecated method builds html table for chords and lyrics
    Returns : html table
    """
    output = "<table>\n"
    output += line_to_html_row(html_chords, "chords")
    output += line_to_html_row(html_lyrics, "lyrics")
    output +="</table>\n"
    return output

def line_to_html_row(line, line_type):
    """Deprecated method builds html row
    Returns : html row
    """
    output = "<tr>\n"
    for elem in line:
        output += '<td class="'+line_type+'">'+elem+"&nbsp;</td>\n"
    output += "</tr>\n"
    return output

# def html_export(in_file, out_file=None):
#     """Parse input file, produce export file of html
#     Return output text (string), optional output file
#     """
def html_export(lines):
    """
    Return output text (string), optional output file
    """
    # # parse file
    # lines = read_file(in_file)
    # print lines
    out_lines = classify_song(lines)

    # split into metadata and sheet music
    metadata = []
    sheet_music = []
    for line in out_lines:
        if line[0] not in ['chords', 'lyrics', 'blank', 'heading']:
            metadata.append(line)
        else:
            sheet_music.append(line)
    out_text = ''
    out_text += html_head('/songs/application/static/css/songs.css')

    # append beginning of metadata
    for data in metadata:
        if data[0] == 'title':
            out_text += '<div class="title">' + data[1] + '</div>\n'
    for data in metadata:
        if data[0] == 'author':
            out_text += data[1] + ' '
    for data in metadata:
        if data[0] == 'copyright':
            out_text += '&copy; ' + data[1] + ', '
    for data in metadata:
        if data[0] == 'ccli':
            out_text += 'CCLI # ' + data[1] #still need ccli #

    # append sheet music
    i = 0
    context = ''
    found_header = False
    while i < len(sheet_music):
        try:
            line = sheet_music[i]
            if found_header:
                if line[0] == 'heading':
                    out_text += '<div class="' + line[0] + '">'
                    out_text += capitalize_first(line[1]) + ' '
                    out_text += '</div>'
                    context = split(line[1])[0]
                    i += 1
                    out_text += '<br>\n'
                    # print line
                elif line[0] == 'chords':
                    lyrics = sheet_music[i+1]
                    out_text += chord_lyric_split(line[1], lyrics[1], 'chords_'+context)
                    i += 2
                    out_text += '<br>\n'
                    # print line
                elif line[0] == 'blank':
                    # print line
                    # out_text += '<br>\n'
                    i += 1
                else:
                    # print line
                    raise UnfinishedParse
            else:
                if line[0] == 'heading':
                    out_text += '<div class="' + line[0] + '">'
                    out_text += capitalize_first(line[1]) + ' '
                    out_text += '</div>'
                    context = split(line[1])[0]
                    i += 1
                    # print line
                    found_header = True
                    out_text += '<br>\n'
                else:
                    if i == 0:
                        out_text += '<div class="title">' + line[1] + '</div>\n'
                    elif i == 1:
                        out_text += '<div class="credits">' + line[1] + '</div>\n'
                    else:
                        out_text += '<br>'
                    i += 1
                    # print line
        except IndexError:
            break

    out_text += html_foot()
    # if out_file != None:
    #     f = open(out_file, 'w')
    #     f.write(out_text)


    # print metadata
    return out_text

def parse_credit_test():
    TEXT_DIR = 'txt'
    songs = os.listdir(TEXT_DIR)
    for i in songs:
        credit_line = read_file(TEXT_DIR + '/' + i)[1]
        print parse_credits(credit_line)

def main():

    s = time.time()
    HTML_DIR = 'html'
    SONG_DIR = 'songs'
    TEXT_DIR = 'txt'
    # print chord_lyric_split(chords, lyrics, 'verse')
    # for i in os.listdir(SONG_DIR):
    #     html_export(SONG_DIR + '/' + i, HTML_DIR + '/' + i)
    # html_export(SONG_DIR + '/' + songs[0], HTML_DIR + '/' + songs[0])
    # print classify_song('txt/Oh Great God')
    # a = html_export(sys.argv[1], sys.argv[2])
    # print re.sub('\’', "'", '’')
    # line = '<body>Body</body>'
    # print is_xml_line(line)
    # print parse_credits(credits)
    # process_upload(read_file(sys.argv[1]))
    parse_credit_test()


    print 'time: %e' % (time.time() - s)

if __name__=='__main__':
    main()
