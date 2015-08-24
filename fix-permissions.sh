#!/bin/bash
chown -R www-data:www-data /usr/share/nginx/design.drama9.com
chmod -R a+rX /usr/share/nginx/design.drama9.com
chmod -R 774 /usr/share/nginx/design.drama9.com/craft/app
chmod -R 774 /usr/share/nginx/design.drama9.com/craft/config
chmod -R 774 /usr/share/nginx/design.drama9.com/craft/storage
