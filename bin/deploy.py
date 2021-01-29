#!/usr/bin/env python3
import subprocess

def exec(command):
    subprocess.call(command.split(" "))

print('Preprocessing stylesheets...')
exec('sass assets/stylesheets/application.scss:assets/style.css')

print('Precompiling HTML templates...')
exec('handlebars assets/templates/ -f assets/js/templatesCompiled.js -e hbs')

print('Running webpack...')
exec('webpack --config assets/webpack.config.js')

FILES = [
    'index.php',
    'assets/lib',
    'assets/img',
    'assets/bootstrap.min.css',
    'assets/js',
    'assets/style.css',
    'assets/bundle.js',
    'blog',
    'experience',
    'projects',
    'sms',
    'westbrook',
    'api',
]

print('Zipping up folder')
exec('zip -r9 deploy.zip ' + ' '.join(FILES))

