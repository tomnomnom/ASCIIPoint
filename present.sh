#! /bin/bash
for i in `ls example-slides/*.php`; do
  php $i&
  #sleep 10
  read -p ""
  kill `ps axufw | grep php | grep example-slides | grep -v grep | awk '{print $2}'` &> /dev/null
done
clear
clear
