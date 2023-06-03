import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="mydb"
,)

mycursor = mydb.cursor()

sql = "INSERT INTO boja (name) VALUES (%s)"
types= [("Bela",),
        ("Bež",),
        ("Bordo",),
        ("Braon",),
        ("Crna",),
        ("Crvena",),
        ("Kameleon",),
        ("Krem",),
        ("Ljubičasta",),
        ("Narandžasta",),
        ("Plava",),
        ("Siva",),
        ("Smeđa",),
        ("Srebrna",),
        ("Tirkiz",),
        ("Teget",),
        ("Zelena",),
        ("Zlatna",),
        ("Žuta",),]
mycursor.executemany(sql,types)
mydb.commit()
print("INSERTED COLORS")