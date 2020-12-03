{literal}

    <article id="comments" class="min-vh-100">
	<section v-if="user" class="d-flex justify-content-around">
		<section>
			<h1 class="text-light"> Agregar un comentario</h1>
			<form id="add">
			
				<label for="content" class="d-none">comentario</label>
				<input type="text" name="content" placeholder="comentario" />
			
				<button type="submit" class="btn btn-dark">Comentar</button>
				<p id="send"></p>
			</form>
			</section>
		<section>
			<h1 class="text-light"> Calificar </h1>
			<form class="calificacion d-flex justify-content-center">
			
				<input id="radio1" type="radio" name="estrellas" value="5" v-bind:checked="5 == calificacion">
				<label for="radio1">★</label>
				<input id="radio2" type="radio" name="estrellas" value="4" v-bind:checked="4 == calificacion">
				<label for="radio2">★</label>
				<input id="radio3" type="radio" name="estrellas" value="3" v-bind:checked="3 == calificacion">
				<label for="radio3">★</label>
				<input id="radio4" type="radio" name="estrellas" value="2" v-bind:checked="2 == calificacion">
				<label for="radio4">★</label>
				<input id="radio5" type="radio" name="estrellas" value="1" v-bind:checked="1 == calificacion">
				<label for="radio5">★</label>
			</form>
			<p id="info" class="text-primary"></p>
		</section>
	</section>
    <h2 class="text-white"> Comentarios: </h2>
        <section  v-for="comment in comments">
			<div class="row" >
				<div class="col-2" v-bind:class="{'bg-info' : user == comment.user}">
					<p>{{ comment.user }}</p>
				</div>
				<div class="col-6">
					<p>{{ comment.content }}</p>
				</div>
				<div class="col-2">
					<p v-if="comment.edited == 1">{{ comment.date_edit }}</p>
					<p v-else> {{ comment.date }} </p>
					<p v-if="comment.edited == 1"><b>Editado</b></p>
				</div>
                <div class="col-2" v-if="(permissions == 'admin' || permissions == 'super admin' || comment.user == user) && comentarios">
                    <button class="btn btn-dark" :data-id=comment.id :data-user=comment.id_user v-on:click="eliminar"> Eliminar </button>
                    <button v-if="comment.user == user" :data-id=comment.id :data-user=comment.id_user class="btn btn-dark" v-on:click="editar"> Modificar </button>
					<button v-if="comment.user == user" class="btn btn-dark d-none" id="sendEdit"> Enviar </button>
					<button v-if="comment.user == user" class="btn btn-dark d-none" id="cancelEdit"> Cancelar </button>
                </div>
			</div>
        </section>
		<div class="row d-flex justify-content-center">
			<a v-if="more" v-on:click="cargarMas" href="#" id="next_page">Cargar más </a>
			<a v-else> No hay más comentarios</a>
		</div>
    </article>

{/literal}


