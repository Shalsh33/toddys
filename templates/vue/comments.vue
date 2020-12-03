{literal}

    <article id="comments" class="min-vh-100">
	<section>
		<form id="add">
			<label for="content">comentario</label>
			<input type="text" name="content" />
			<button type="submit" class="btn btn-dark">Comentar</button>
		</form>
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
                    <button v-if="comment.user == user" :data-id=comment.id :data-user=comment.id_user class="btn btn-dark"> Modificar </button>
                </div>
			</div>
        </section>
		<div class="row d-flex justify-content-center">
			<a v-if="more" v-on:click="cargarMas" href="#" id="next_page">Cargar más </a>
			<a v-else> No hay más comentarios</a>
		</div>
    </article>

{/literal}


