import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="mydb"
,)

mycursor = mydb.cursor()

sql = "INSERT INTO brands (name) VALUES (%s)"

vals = [
("Audi",),
("Aston Martin",),
("Alfa Romeo",),
("Bentley",),
("BMW",),
("Buick",),
("Cadillac",),
("Chevrolet",),
("Chrysler",),
("Daewoo",),
("Dodge",),
("Ferrari",),
("Fiat",),
("Ford",),
("Honda",),
("Hummer",),
("Hyundai",),
("Infiniti",),
("Jaguar",),
("Jeep",),
("Kia",),
("Lamborghini",),
("Land Rover",),
("Lexus",),
("Lotus",),
("Maserati",),
("Mazda",),
("Mercedes Benz",),
("MG",),
("Mini",),
("Mitsubishi",),
("Nissan",),
("Peugeot",),
("Porsche",),
("Ram",),
("Renault",),
("Rolls Royce",),
("Saab",),
("Smart",),
("Subaru",),
("Suzuki",),
("Toyota",),
("Volkswagen",),
("Volvo",),
("Yugo",)
]

mycursor.executemany(sql,vals)
mydb.commit()
print("INSERTED BRANDS")

