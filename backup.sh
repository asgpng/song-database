#!/bin/sh

if [ $# -lt 2 ]; then
    echo "Too few arguments. Usage: $0 source $1 destination" >&2
    exit 1
elif [ $# -gt 2 ]; then
    echo "Too many arguments. Usage: $0 source $1 destination" >&2
    exit 1
fi

# echo "total time: $(( ($FINISH-$START) / 60 )) minutes, $(( ($FINISH-$START) % 60 )) seconds"

rsync -avzhn $1 $2 --delete --exclude .git/* --exclude upload/* --exclude ace-builds/*

# songs

# penguins:/u/asg4/public_html/songs
