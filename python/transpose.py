#!/usr/bin/python2
import sys
from song_parser import *

def main():
    lines = read_file(sys.argv[1])
    lines = '\n'.join(transpose_lines(lines, int(sys.argv[2])))
    lines = re.sub('\n\n', '\n', lines)
    print lines
    sys.exit(0)

if __name__=='__main__':
    main()
