<template>
	<form class="login-form">
		<p class="login-form__error" hidden></p>
		<div class="login-form__inputs">
			<label for="user_email">Title</label>
			<input id="user_email" v-model.trim="title" placeholder="Make a homework" required>
		</div>
		<div class="login-form__inputs">
			<label for="user_pass">Description</label>
			<textarea id="user_pass" v-model.trim="description" placeholder="English: p. 156 ex. 31" required>...</textarea>
		</div>
		<input type="submit" value="Create" v-on:click.prevent="create()">
	</form>
</template>

<script>
export default {
	data() {
		return {
			user_id: null,
			title: null,
			description: null,
		}
	},
	mounted() {  },
	methods: {
		async create() {
			var app = this;
			let task = {
				title: app.title,
				description: app.description,
			}

			const user_request = await axios
				.get('api/user', {
					headers: {
						Accept: 'application/json',
						Authorization: 'Bearer ' + localStorage.getItem('accessToken'),
					}
				})
				.catch(error => console.log(error))
			let user = user_request.data;
			
			const response = await axios
				.post('api/task_create?' + new URLSearchParams({
					user_id: user.id,
					title: task.title,
					description: task.description, }), 
					{
						headers: {
							Accept: 'application/json',
							Authorization: 'Bearer ' + localStorage.getItem('accessToken'),
						}
					})
				.catch(error => console.log(error));
			window.location.replace('http://127.0.0.1:8000/tasks');
		}
	}
}
</script>
