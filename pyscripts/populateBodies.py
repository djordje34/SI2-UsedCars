import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="mydb"
,)

mycursor = mydb.cursor()

sql = "INSERT INTO body (type) VALUES (%s)"
types= [("limuzina",),("hečbek",),("kupe",),("SUV",),("minivan",),("karavan",),("kabriolet",)]
mycursor.executemany(sql,types)
mydb.commit()
print("INSERTED BODY")