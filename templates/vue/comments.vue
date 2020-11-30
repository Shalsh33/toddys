{literal}

    <article id="comments">
        <section v-for="comment in comments">
			<div class="row">
				<div class="col-2">
					<p>{{ comment.email }}</p>
				</div>
				<div class="col-7">
					<p>{{ comment.content }}</p>
				</div>
				<div class="col-3">
					<p v-if="comment.edited">{{ comment.date_edited }}</p>
					<p v-else> {{ comment.date }} </p>
					<p v-if="comment.edited"><b>Editado</b></p>
				</div>
			</div>
        </section>
    </article>

{/literal}


