#!/usr/bin/env python3
import subprocess

def exec(command):
    subprocess.call(command.split(" "))

print('Preprocessing stylesheets...')
exec('sass assets/stylesheets/application.scss:assets/style.css')

print('Precompiling HTML templates...')
exec('handlebars assets/templates/ -f assets/js/templatesCompiled.js -e hbs')


FILES = [
    'index.php',
    'assets/lib',
    'assets/bootstrap.min.css',
    'assets/js',
    'assets/style.css',
    'blog',
    'experience',
    'projects',
    'sms',
    'westbrook',
    'api',
]

print('Zipping up folder')
exec('zip -r9 deploy.zip ' + ' '.join(FILES)) 

