#############################
SQLDumpSplitter 2 1.0
(C) 2002 by Philip (Alibi)     
#############################

+++++++++++++++++++++++++++++++++
E-Mail = philip@philiplb.de   
Homepage = http://www.philiplb.de
+++++++++++++++++++++++++++++++++

PHPMyAdmin hat in den meisten Fällen eine maximale Dateigröße
beim Einspielen von Dumpfiles. Wenn man aber eine größere Datenbank hat
ist die Datei, die PHPMyAdmin erstellt weitaus größer. Dieses Tool splittet
die Datei in mehrere auf, deren Zielgröße eingestellt werden kann, so dass sie problemlos
wieder eingespielt werden können. Nach einer Idee von Werwolf.

History:
~~~~~~~~~~~~~~~~~~~~

SQLDumpSplitter 2 1.0:
- Kompletter Rewrite.
- Drag & Drop des SQL-Files wird unterstützt.
- Das SQL-File kann als Parameter beim Programmstart angegeben werden (SQLDumpSplitter Backup.sql oder
  die Datei einfach auf das Icon der .exe ziehen).
- Es kann nun bei der maximalen Dateigröße zwischen Bytes, Kilobytes und Megabytes ausgewählt werden.
- Es werden vorabe Informationen angezeigt, wie die entsprechenden Dateigrößen in Bytes, Kilobytes, Megabytes und
  die zu erwartende Anzahl der gesplitteten Dateien.
- Es kann nun ein Zielverzeichnis für die Dateien angegeben werden.
- Kommentarzeilen in der .sql-Datei können nun übersprungen werden, sie landen nicht mehr in den gesplitteten Dateien. 

Version 1.0:
Die erste Version, die veröffentlicht wurde.


Philip