from flask import Flask, request, jsonify, render_template
import mysql.connector
from mysql.connector import Error

app = Flask(__name__)

# Conexión a la base de datos
def conectar_db():
    try:
        conn = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="paginaBD"
        )
        if conn.is_connected():
            return conn
    except Error as e:
        print(f"Error al conectar a MySQL: {e}")
        return None

# Ruta para la página principal
@app.route('/')
def index():
    return render_template('index.php')

# Ruta para insertar datos
@app.route('/insertar', methods=['POST'])
def insertar():
    datos = request.json  # Recibir datos en formato JSON desde el front-end
    tabla = datos.get('tabla')
    valores = datos.get('valores')

    if not tabla or not valores:
        return jsonify({'error': 'Tabla o valores no especificados'}), 400

    try:
        with conectar_db() as conn:
            cursor = conn.cursor()
            placeholders = ', '.join(['%s'] * len(valores))
            query = f"INSERT INTO {tabla} VALUES (NULL, {placeholders})"
            cursor.execute(query, valores)
            conn.commit()
            return jsonify({'mensaje': 'Datos insertados correctamente'}), 200
    except Error as e:
        return jsonify({'error': str(e)}), 500

# Ruta para mostrar datos
@app.route('/mostrar/<tabla>', methods=['GET'])
def mostrar(tabla):
    try:
        with conectar_db() as conn:
            cursor = conn.cursor()
            query = f"SELECT * FROM {tabla}"
            cursor.execute(query)
            registros = cursor.fetchall()
            return jsonify(registros), 200
    except Error as e:
        return jsonify({'error': str(e)}), 500

# Ruta para actualizar datos
@app.route('/actualizar', methods=['PUT'])
def actualizar():
    datos = request.json  # Recibir datos en formato JSON desde el front-end
    tabla = datos.get('tabla')
    columna_id = datos.get('columna_id')
    id_valor = datos.get('id_valor')
    actualizaciones = datos.get('actualizaciones')

    if not tabla or not columna_id or not id_valor or not actualizaciones:
        return jsonify({'error': 'Datos insuficientes para actualizar'}), 400

    try:
        with conectar_db() as conn:
            cursor = conn.cursor()
            set_clause = ', '.join([f"{col} = %s" for col in actualizaciones.keys()])
            query = f"UPDATE {tabla} SET {set_clause} WHERE {columna_id} = %s"
            cursor.execute(query, (*actualizaciones.values(), id_valor))
            conn.commit()
            return jsonify({'mensaje': 'Registro actualizado correctamente'}), 200
    except Error as e:
        return jsonify({'error': str(e)}), 500

# Ruta para eliminar datos
@app.route('/eliminar', methods=['DELETE'])
def eliminar():
    datos = request.json
    tabla = datos.get('tabla')
    columna_id = datos.get('columna_id')
    id_valor = datos.get('id_valor')

    if not tabla or not columna_id or not id_valor:
        return jsonify({'error': 'Datos insuficientes para eliminar'}), 400

    try:
        with conectar_db() as conn:
            cursor = conn.cursor()
            query = f"DELETE FROM {tabla} WHERE {columna_id} = %s"
            cursor.execute(query, (id_valor,))
            conn.commit()
            return jsonify({'mensaje': 'Registro eliminado correctamente'}), 200
    except Error as e:
        return jsonify({'error': str(e)}), 500

# Ejecutar el servidor
if __name__ == "__main__":
    app.run(debug=True)
