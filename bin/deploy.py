#!/usr/bin/env python3
import subprocess

def exec(command):
    subprocess.call(command.split(" "))

print('Preprocessing stylesheets...')
exec('sass assets/stylesheets/application.scss:assets/style.css')

print('Precompiling HTML templates...')
exec('handlebars assets/templates/ -f assets/js/templatesCompiled.js -e hbs')

