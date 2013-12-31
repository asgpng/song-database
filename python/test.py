#!/usr/bin/python2.7
import sys
from song_parser import *

def main():
    lines = read_file(sys.argv[1])
    process_upload(lines)
    # title = lines[0]
    # print title


    # print sys.argv[1]
    # print split('C B D')

if __name__=='__main__':
    main()
