#! /bin/bash
for i in `ls example-slides/*.php`; do # Change to slides/*.php if you're using your own rather than the examples.
  php $i&
  #sleep 10
  read -p ""
  kill `ps axufw | grep php | grep slides | grep -v grep | awk '{print $2}'` &> /dev/null
done
clear
clear
