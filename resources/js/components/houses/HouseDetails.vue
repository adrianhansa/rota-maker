<template>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				<router-link :to="{name:'houses.edit', params:{slug:house.slug}}">{{ house.name }}</router-link><br>
				<router-link :to="{name:'employees.create', params:{house:house.slug}}">Add staff</router-link><br>
				<router-link :to="{name:'employeesByHouse', params:{house:house.slug}}">Employees ({{ house.employees.length }})</router-link><br>
				<router-link :to="{name:'rota.dashboard',params:{house:house.slug}}">Rota</router-link><br>
				<a href="#" class="btn btn-sm btn-danger pull-right mr-1" @click.prevent="del(house.id)"><i class="fa fa-trash"></i></a>
			</h5>
			<p class="card-text">{{ house.address }}</p>
		</div>
	</div>
</template>

<script>
	export default{
		props:['house'],
		methods:{
			edit(house){
				this.$store.dispatch('updateHouse',house);
			},
			del(id){
				this.$store.dispatch('deleteHouse',id);
				this.$router.push({name:'houses.index'});
				this.$store.dispatch('getHouses');
			},
			update(slug){
				this.$store.dispatch('updatedHouse',slug);
			}
		}
	}
</script>
