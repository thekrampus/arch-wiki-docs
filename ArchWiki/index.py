"""
Module to create a static index for the mirror from a template.
Keys populated by this module are of the form ${key.name}.
"""

import os
import datetime
import subprocess
from lxml.html import builder as E
from lxml import html

from ArchWiki import language_names

__all__ = ["build_index"]

# path to template
default_template_path = os.path.join('templates', 'index.html')

# default template key values
template_keys = {
    'mirror.name': 'local',
    'mirror.date': 'the last update',
    'mirror.locale.main': 'en',
    'mirror.locale.content': '',
    'app.url': 'https://github.com/thekrampus/arch-wiki-docs',
    'app.name': 'arch-wiki-docs',
    'app.version': '1.0',
}

# datetime format string
date_format = '%a, %d %b %Y %H:%M:%S'

# build map from locales to language names
locales = {v['subtag']: k for k, v in language_names.items()}

def build_index(out_path, template_path=default_template_path, arg_keys={}):
    out_file = os.path.join(out_path, 'index.html')
    print("Building index at {}".format(out_file))
    populate_keys(arg_keys)
    build_locale_content()
    with open(template_path, 'r') as template_in:
        index = template_in.read()
    for key, value in template_keys.items():
        index = index.replace('${{{}}}'.format(key), value)
    with open(out_file, 'wb') as out:
        out.write(index.encode('utf-8'))

def populate_keys(arg_keys={}):
    # add keys passed as arguments (overrides default & detected keys)
    template_keys.update(arg_keys)
    if 'mirror.name' not in arg_keys:
        # use hostname
        template_keys['mirror.name'] = os.uname()[1]
    if 'mirror.date' not in arg_keys:
        # use current time
        template_keys['mirror.date'] = datetime.datetime.now().strftime(date_format)
    if 'app.version' not in arg_keys:
        # get version from git
        proc = subprocess.run(['git', 'describe',
                               '--always', '--dirty', '--long', '--tags'],
                              stdout=subprocess.PIPE)
        if proc.returncode == 0:
            template_keys['app.version'] = proc.stdout.decode('utf-8')

def _locale_link(locale):
    return E.A(locales[locale],
               href="{}/Main_page.html".format(locale),
               title="Main Page")

def build_locale_content():
    main = template_keys['mirror.locale.main']
    content = E.DIV(E.P("Browse in ", _locale_link(main), ", or:"))
    ul = E.UL()
    for locale in locales:
        ul.append(E.LI(_locale_link(locale)))
    content.append(ul)
    template_keys['mirror.locale.content'] = html.tostring(content).decode('utf-8')
