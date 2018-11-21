<template>
	<div class="row mt-3">
		<div class="col-12">
			<div class="jumbotron jumbotron-fluid bg-white">
			  <h1 class="display-2 ml-5">Welcome, {{user.name}}!</h1>
			  <hr class="my-4">
			  <p class="ml-5">Enjoy creating new rotas to cover with staff the company's needs!</p>
			  <div class="container">
				<router-link :to="{name:'employeesByHouse', params:{house:user.house_slug}}" class="btn btn-primary btn-lg">Manage Staff</router-link>
				<router-link :to="{name:'rota.dashboard',params:{house:user.house_slug}}" class="btn btn-success btn-lg">Rota Creator</router-link>
				<router-link :to="{name:'shifts.index',params:{house:user.house_slug}}" class="btn btn-info btn-lg">Manage Shifts</router-link>
			  </div>
			</div>
		</div>
	</div>
</template>

<script>
	import {mapGetters} from 'vuex'
	export default{
		computed:{
			...mapGetters(['house','user'])
		},
		methods:{
			getDatetime(){
				return new Date().getTime()+', '+new Date().getDate();
			}
		},
		created(){
			this.getDatetime();
		}
	}
</script>