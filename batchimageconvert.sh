#! /bin/bash

for filename in `ls images/*.jpg`;
do
    echo Converting $filename
    jp2a --height=26 -i $filename > $filename.txt
done
echo Conversion complete.
