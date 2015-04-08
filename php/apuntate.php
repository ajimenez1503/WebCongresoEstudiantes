<!--Copyright ©. All rights reserved. Designed by Antonio Jimenez Martinez y Andres Ortiz Corrales -->
<!DOCTYPE html>
			<p>
Para apuntarse es necesario rellenar el formulario y enviar una transferencia la proximo numero de cuenta: 123456789.
			</p>
			 <p>
El precio de cada actividad es de 2€. El precio de la inscripcion depende del rol:</p>
			<li ><p> 10€ para estudiante</p></li>
			<li ><p> 15€ para profesor</p></li>
			<li ><p> 20€ para invitado</p></li>

			<p>
Manda un mensaje a <a href="congreso@ugr.es">congreso@ugr.es </a> en caso de duda.
</p>

			<form >
				<fieldset>
					<legend><h4>Datos:</h4></legend>
					<label>Nombre</label> <input id="formNombre" type="text" size="30"><br>
					<label>Apellidos</label> <input id="formApellidos" type="text" size="30"><br>
					<label>Correo Electronico</label> <input id="formMail" type="text" size="30"><br>
					<br>
					<label><h4>Ocupación</h4></label>
							<select name="rol">
							<option  id="option1" value="estudiante">Estudiante</option>
							<option id="option2" value="profesor">Profesor</option>
							<option  id="option3" value="visitante">Visitante</option>
							</select>
				<br>
				<br>
				<h4>Actividades</h4>
					<input id="checkbox1" type="checkbox" name="actividad" value="Campeonato de LoL">Campeonato de LoL<br>
					<input id="checkbox2" type="checkbox" name="actividad" value="Picnic en sala de ordenadores">Picnic en sala de ordenadores<br>
					<input id="checkbox3" type="checkbox" name="actividad" value="Campeonato futbolin">Campeonato futbolin<br>
					<input id="checkbox4" type="checkbox" name="actividad" value="Partido de futbol">Partido de futbol<br>
					<input id="checkbox5" type="checkbox" name="actividad" value="Taller: Introducción a WordPad">Taller: Introducción a WordPad<br>
				</fieldset>
			</form>
			<button type="button" onClick="formSubmit()">Submit</button>
			<p class="totalDinero" id="dinero">
			Total: 0€
			</p>
