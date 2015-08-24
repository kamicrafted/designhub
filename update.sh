#!/bin/sh
cd /usr/share/nginx/design.drama9.com
git pull
npm install
bower install
gulp build
/usr/share/nginx/design.drama9.com/fix-permissions.sh 
