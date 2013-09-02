Internationalization
====================

Translation credits
-------------------

| Code     | Language               | Translator            |
| -------- | ---------------------- | --------------------- |
| `fr_FR`  | French                 | [Lumière de Lune](http://www.lumieredelune.com/) |
| `nl_NL`  | Dutch                  | Rob Meerwijk          |
| `pl_PL`  | Polish                 | Katarzyna Matylla     |
| `tr_TR`  | Turkish                | Ozan Çağlayan         |


Translating the Theme
---------------------

1. Fetch the translation template file named `emphaino.pot` from the `languages` directory. Open it.
2. Translate the strings in your language, provide other details and save it as a 'po' file. The file should be named in the format `xx_YY.po`, where xx refers to the language code and YY to the locale. For example, the French po file will have the name `fr_FR.po`. This xx_YY should be the same as the value you define for WPLANG in wp-config.php.
3. Create an 'mo' file based on your 'po' file using the [GNU gettext utility](http://www.gnu.org/software/gettext/gettext.html), and name it in the format `xx_YY.mo` similar to your 'po' file.
4. The 'po' and 'mo' files should go in the `languages` directory of the theme. If WPLANG is set in wp-config.php, your site will should show the translated strings instead of the original strings.

Instead of manually editing the 'po' file and generating an 'mo' file, you can use an application like [poEdit](http://www.poedit.net/).

If you wish to share your translation, send the files to the theme author (srinig.com@gmail.com) and your translation will be bundled with the next version of the theme. You can also send a pull request to https://github.com/sriniguna/emphaino.


Useful links
------------

Please visit the following links to learn more about translating WordPress themes:

* http://codex.wordpress.org/Translating_WordPress
* http://codex.wordpress.org/Function_Reference/load_theme_textdomain
