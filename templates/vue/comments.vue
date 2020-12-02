{literal}

    <article id="comments">
    <h2 class="text-white"> Comentarios: </h2>
        <section v-for="comment in comments">
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
                    <button class="btn btn-dark"> Eliminar </button>
                    <button v-if="comment.user == user" class="btn btn-dark"> Modificar </button>
                </div>
			</div>
        </section>
    </article>

{/literal}


