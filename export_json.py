import json
import mysql.connector

# Leer el archivo JSON
with open('provincias-espanolas.json', 'r') as f:
    data = json.load(f)

# Conexión a la base de datos
cnx = mysql.connector.connect(user='root', password='',
                              host='127.0.0.1',
                              database='sane_backend')

cursor = cnx.cursor()

# Insertar los datos en la tabla
for item in data:
    geo_point_2d = item.get('geo_point_2d', {})
    geo_shape = item.get('geo_shape', {})
    query = "INSERT INTO provincias (lon, lat, type, geometry, ccaa, cod_ccaa, provincia, texto, codigo) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)"
    cursor.execute(query, (geo_point_2d.get('lon'), geo_point_2d.get('lat'), geo_shape.get('type'), str(geo_shape.get('geometry')), item.get('ccaa'), item.get('cod_ccaa'), item.get('provincia'), item.get('texto'), item.get('codigo')))

# Confirmar la transacción
cnx.commit()

cursor.close()
cnx.close()
