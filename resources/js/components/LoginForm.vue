<template>
	<form class="login-form">
		<p class="login-form__error" hidden></p>
		<div class="login-form__inputs">
			<label for="user_email">Email</label>
			<input id="user_email" v-model.trim="email" placegoler="qwerty@mail.ru" required>
		</div>
		<div class="login-form__inputs">
			<label for="user_pass">Password</label>
			<input id="user_pass" v-model.trim="password" placeholder="1234" required>
		</div>
		<input type="submit" value="Sign in" v-on:click.prevent="signIn()">
	</form>
</template>

<script>
export default {
	data() {
		return {
			email: null,
			password: null,
		}
	},
	mounted() {  },
	methods: {
		async signIn() {
			var app = this;
			let user = {
				email: app.email,
				password: app.password,
			}
			
			const response = await axios
				.get('api/login?' + new URLSearchParams({
					email: user.email,
					password: app.password, }))
				.catch(error => console.log(error));
			let token = response.data.data.token;
			localStorage.setItem('accessToken', token);
			window.location.replace('http://127.0.0.1:8000/tasks');
		}
	}
}
</script>
