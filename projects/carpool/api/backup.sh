#!/bin/bash
svn up /var/www/ #update subversion directory first
rsync -ap --exclude=.svn /var/www/* ~/www_backup #copy folder to home directory
mysqldump -u carpool -pF00tball1 -d carpool > backup.sql
