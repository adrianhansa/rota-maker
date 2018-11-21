<template>
	<div class="row mt-3">
		<div class="col-4 mx-auto">
			<div class="card">
				<h3 class="text-center card-title mt-4">Edit Shift</h3>
				<div class="card-body">
					<form>
					  	<div class="form-group">
					    	<label for="name">Name:</label>
					    	<input type="text" class="form-control" v-model="shift.name" id="name">
					    	<ul v-if="errors.name">
					    		<li v-for="error in errors.name">{{ error }}</li>
					    	</ul>
					  	</div>
					  	<div class="form-group">
					    	<label for="start">Start:</label>
					    	<input type="text" id="start" class="form-control" v-model="shift.start">
					    	<ul v-if="errors.start">
					    		<li v-for="error in errors.start">{{ error }}</li>
					    	</ul>
					  	</div>
					  	<div class="form-group">
					    	<label for="end">End:</label>
					    	<input type="text" id="end" class="form-control" v-model="shift.end">
					    	<ul v-if="errors.end">
					    		<li v-for="error in errors.end">{{ error }}</li>
					    	</ul>
					  	</div>
					  	<div class="form-group">
					    	<label for="duration">Duration:</label>
					    	<input type="text" id="duration" class="form-control" v-model="shift.duration">
					    	<ul v-if="errors.duration">
					    		<li v-for="error in errors.duration">{{ error }}</li>
					    	</ul>
					  	</div>
				  	<button @click.prevent="updateShift" class="btn btn-success">Update Shift</button>
				  	<router-link :to="{name: 'shifts.index',params:{house:$route.params.house}}" class="btn btn-secondary">Cancel</router-link>
				</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import {mapGetters} from 'vuex'
	export default{
		computed:{
			...mapGetters(['user','house'])
		},
		data(){
			return{
				shift:{},
				errors:{}
			}
		},
		methods:{
			updateShift(){
				axios.put('/shifts/'+this.shift.id,this.shift)
					 .then((response)=>this.$router.push({name:'shifts.index',params:{house:this.$route.params.house}}))
					 .catch((error)=>this.errors = error.response.data.errors);
			},
			getShift(){
				axios.get('/shifts/'+this.$route.params.id)
					 .then((response)=>this.shift=response.data)
					 .catch((error)=>console.log(error));
			}
		},
		created(){
			this.getShift();
			this.$store.dispatch('getHouse',this.$route.params.house);
		}
	}
</script>