<template>
	<div class="row justify-content-center">
		<div class="col-12">
			<h1>Users <small><router-link :to="{name: 'users.create'}"><i class="fa fa-plus"></i></router-link></small></h1>
			<table class="table table-striped">
				<thead>
					<th>Name</th>
					<th>Email</th>
					<th>Admin rights</th>
					<th><span class="pull-right">Edit/Delete</span></th>
				</thead>
				<tbody>
					<tr v-for="user in users">
						<td>{{ user.name }}</td>
						<td>{{ user.email }}</td>
						<td>{{ user.admin }}</td>
						<td>
							<a href="#" class="btn btn-sm btn-danger pull-right ml-1" @click.prevent="del(user.id)"><i class="fa fa-trash"></i></a>
							<router-link :to="{name: 'users.edit', params:{id:user.id}}" class="btn btn-sm btn-success pull-right"><i class="fa fa-pencil"></i></router-link>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
import {mapGetters} from 'vuex'
import {mapActions} from 'vuex'

	export default{
		computed:{
			...mapGetters(['users'])
		},
		methods:{
			...mapActions(['getUsers']),
			del(id){
				this.$store.dispatch('deleteUser',id);
				this.$router.push({name:'users.index'});
				this.$store.dispatch('getUsers');
			}
		},
		created(){
			this.getUsers();
		}
	}
</script>