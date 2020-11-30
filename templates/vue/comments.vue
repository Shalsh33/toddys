{literal}

    <article id="comments">
        <section v-for="comment in comments">
			<div class="row">
				<div class="col-2">
					<p>{{ comment.user }}</p>
				</div>
				<div class="col-8">
					<p>{{ comment.content }}</p>
				</div>
				<div class="col-2">
					<p>{{ comment.date }}</p>
					<p v-if="comment.edited"><b>Editado</b></p>
				</div>
			</div>
        </section>
    </article>

{/literal}


