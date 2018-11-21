<template>
	<div class="row">
		<div class="col-12">
			<h1>Employees By House <router-link class="btn btn-sm btn-primary" :to="{name:'employees.create',params:{house:$route.params.house}}"><i class="fa fa-plus"></i></router-link></h1>
			<table class="table table-striped">
				<thead>
					<th>Name</th>
					<th>Position</th>
					<th>Contract hours</th>
					<th>Driver</th>
					<th>Medi trained</th>
					<th>Edit/Delete</th>
				</thead>
				<tbody>
					<tr v-for="employee in employeesByHouse">
						<td>{{ employee.name }}</td>
						<td>{{ employee.position }}</td>
						<td>{{ employee.contracted_hours }}</td>
						<td>{{ employee.driver ? 'yes':'no' }}</td>
						<td>{{ employee.medi_trained ? 'yes':'no' }}</td>
						<td>
							<a href="#" class="btn btn-sm btn-danger pull-right" @click.prevent="del(employee.slug)"><i class="fa fa-trash"></i></a>
							<router-link :to="{name: 'employees.edit', params:{slug:employee.slug,house:$route.params.house}}" class="btn btn-sm btn-success pull-right mr-1"><i class="fa fa-pencil"></i></router-link>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
import {mapGetters} from 'vuex'

	export default{
		methods:{
			del(slug){
				this.$store.dispatch('deleteEmployee',slug);
				this.$router.push({name:'employeesByHouse',params:{house:this.$route.params.house}});
				this.$store.dispatch('getEmployeesByHouse',this.$route.params.house);
			}
		},
		computed:{
			...mapGetters(['employeesByHouse'])
		},
		created(){
			this.$store.dispatch('getEmployeesByHouse',this.$route.params.house);
		}
	}
</script>