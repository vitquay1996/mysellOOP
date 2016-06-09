Mysell PHP project
==============================

#Huong Dan Cai Dat:
- Backup Sql bang file mysell.sql
- Dung editer de mo file /models/Dao/DA.php
- Thay doi username va password
- Bat dau tu trang index.php

File DAO.php em co 1 so modification nhu sau:
- Dong 246 o function getObject va dong 297 o getObjects em them 1 cau if
de tranh no return empty object.
- Bien primkeys thanh public de lay duoc no.
- Dong 214 o function addFiels em them 1 cau if de no ko add value cho 
cot ID (bt no se add value la NULL)

Tat ca cac loai tinh toan statistics em cho vao file Count.php va dateCount.php

