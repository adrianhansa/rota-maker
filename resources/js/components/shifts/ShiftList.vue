<template>
	<div class="row mt-3">
		<div class="col-6 mx-auto">
			<h1 class="text-center">Shift List 
				<router-link :to="{name:'shifts.create',params:{house:$route.params.house}}"><i class="fa fa-plus"></i></router-link>
			</h1>
			<table class="table table-striped">
				<thead>
					<th>Shift name</th>
					<th>Start time</th>
					<th>End time</th>
					<th>Duration</th>
					<th>Edit/Delete</th>
				</thead>
				<tbody>
					<tr v-for="shift in shifts">
						<td>{{ shift.name }}</td>
						<td>{{ shift.start }}</td>
						<td>{{ shift.end }}</td>
						<td>{{ shift.duration }}</td>
						<td>
							<router-link :to="{name: 'shifts.edit', params:{id:shift.id,house:$route.params.house}}" class="btn btn-sm btn-success pull-right"><i class="fa fa-pencil"></i></router-link>
							<button class="btn btn-sm btn-danger pull-right mr-1" @click.prevent="del(shift.id)"><i class="fa fa-trash"></i></button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				shifts:{}
			}
		},
		methods:{
			del(id){
				axios.delete('/shifts/'+id)
					 .then((response)=>this.getShifts())
					 .catch((error)=>console.log(error));
			},
			getShifts(){
				axios.get('/shifts').then((response)=>this.shifts=response.data).catch((error)=>console.log(error));
			}
		},
		created(){
			this.getShifts();
		}
	}
</script>