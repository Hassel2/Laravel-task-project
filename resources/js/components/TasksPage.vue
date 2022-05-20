<template>
	<div class="content-wraper">
		<div class="task" v-for="task in tasks">
			<div class="task__title-box">
				<p class="title"> {{ task.title }} </p>
			</div>
			<div class="task__desc-box">
				<p class="desc"> {{ task.description }} </p>
			</div>
			<input type="button" class="button" value="Delete">
			<input type="button" class="button" value="Update">
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			tasks: null,
		}; 
	},
	mounted() {
		axios
			.get('api/tasks_show', {
				headers: {
					Accept: 'application/json',
					Authorization: 'Bearer ' + localStorage.getItem('accessToken'),
				}
			})
			.catch(error => console.log(error))
			.then(response => (this.tasks = response.data.data));
	},
	methods: {
		async load() {
		}
	}
}
</script>
