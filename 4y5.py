from datetime import datetime, timedelta #importar esto para que funciona bn

#copiar y pegar

#Ingreso de la compañia en los ultimos 31 dias.
@app.route('/api/facturas/fecha/<fecha1>', methods=['GET'])
def get_facturas_monto(fecha1):
    try:

        string_fecha = str(fecha1)
        fecha_act_aux = datetime.strptime(string_fecha, "%Y-%m-%d")
        fecha_atd_aux = fecha_act_aux - timedelta(days=31)
        fecha_atd = fecha_atd_aux.strftime('%Y-%m-%d')
        fecha_act = fecha_act_aux.strftime('%Y-%m-%d')
        query = db.text('SELECT sum(monto_facturado) FROM facturas WHERE fecha_hora_pago >  \'' +str(fecha_atd)+ '\'  AND fecha_hora_pago <  \'' +str(fecha_act)+ '\' order by sum')
        rs = db.session.execute(query)
        monto = [{'qty_dinero': row[0]} for row in rs]
        response = jsonify(monto)
        return response
    except:
        response = jsonify({})
        return response

#Obtener top10
@app.route('/api/canciones/top/<id>', methods=['GET'])
def get_top(id):
    try:
        query = db.text('select id, nombre, tabla.cantidad_reproducciones from canciones join(select id_cancion, id_usuario, cantidad_reproducciones from reproducciones) as tabla on tabla.id_cancion = canciones.id and id_usuario = ' + str(id) +  ' order by tabla.cantidad_reproducciones desc limit 10;')

        rs = db.session.execute(query)        
        top_ten = [{'id': row[0],'nombre': row[1],'vistas': row[2]} for row in rs]
        response = jsonify(top_ten)
        if (top_ten == []): response = jsonify({'Mensaje' : 'No hay canciones.'})
        
        return response
    except:
        response = jsonify({})
        return response