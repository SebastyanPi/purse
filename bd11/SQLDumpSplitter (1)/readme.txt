#############################
SQLDumpSplitter 2 1.0
(C) 2002 by Philip (Alibi)     
#############################

+++++++++++++++++++++++++++++++++
E-Mail = philip@philiplb.de   
Homepage = http://www.philiplb.de
+++++++++++++++++++++++++++++++++

PHPMyAdmin hat in den meisten F�llen eine maximale Dateigr��e
beim Einspielen von Dumpfiles. Wenn man aber eine gr��ere Datenbank hat
ist die Datei, die PHPMyAdmin erstellt weitaus gr��er. Dieses Tool splittet
die Datei in mehrere auf, deren Zielgr��e eingestellt werden kann, so dass sie problemlos
wieder eingespielt werden k�nnen. Nach einer Idee von Werwolf.

History:
~~~~~~~~~~~~~~~~~~~~

SQLDumpSplitter 2 1.0:
- Kompletter Rewrite.
- Drag & Drop des SQL-Files wird unterst�tzt.
- Das SQL-File kann als Parameter beim Programmstart angegeben werden (SQLDumpSplitter Backup.sql oder
  die Datei einfach auf das Icon der .exe ziehen).
- Es kann nun bei der maximalen Dateigr��e zwischen Bytes, Kilobytes und Megabytes ausgew�hlt werden.
- Es werden vorabe Informationen angezeigt, wie die entsprechenden Dateigr��en in Bytes, Kilobytes, Megabytes und
  die zu erwartende Anzahl der gesplitteten Dateien.
- Es kann nun ein Zielverzeichnis f�r die Dateien angegeben werden.
- Kommentarzeilen in der .sql-Datei k�nnen nun �bersprungen werden, sie landen nicht mehr in den gesplitteten Dateien. 

Version 1.0:
Die erste Version, die ver�ffentlicht wurde.


Philip