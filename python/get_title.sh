#!/usr/bin/python
import sys
from song_parser import *

def main():
    lines = read_file(sys.argv[1])
    print get_title(lines)

if __name__=='__main__':
    main()
