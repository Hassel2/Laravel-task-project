<template>
	<form class="login-form">
		<p class="login-form__error" hidden></p>
		<div class="login-form__inputs">
			<label for="user_email">Name</label>
			<input id="user_email" v-model.trim="name" placegoler="Ivan" required>
		</div>
		<div class="login-form__inputs">
			<label for="user_email">Email</label>
			<input id="user_email" v-model.trim="email" placegoler="qwerty@mail.ru" required>
		</div>
		<div class="login-form__inputs">
			<label for="user_pass">Password</label>
			<input id="user_pass" v-model.trim="password" placeholder="1234" required>
		</div>
		<div class="login-form__inputs">
			<label for="user_email">Repeat password</label>
			<input id="user_email" v-model.trim="c_password" placegoler="1234" required>
		</div>
		<input type="submit" value="Sign up" v-on:click.prevent="signIn()">
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
				name: app.name,
				email: app.email,
				password: app.password,
				c_password: app.c_password,
			}
			
			const response = await axios
				.get('api/register?' + new URLSearchParams({
					name: user.name,
					email: user.email,
					password: user.password,
					c_password: user.c_password
				}))
				.catch(error => console.log(error));
			let token = response.data.data.token;
			localStorage.setItem('accessToken', token);
			window.location.replace('http://127.0.0.1:8000/tasks');
		}
	}
}
</script>
