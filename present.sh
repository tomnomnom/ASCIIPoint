#! /bin/bash
for i in `ls example-slides/*.php`; do
  php $i&
  sleep 10
  kill `ps axufw | grep php | grep example-slides | grep -v grep | awk '{print $2}'`
done
