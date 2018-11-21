<template>
	            <div class="card">
	                <div class="card-body">
	                    <form>
	                        <div class="form-group row">
	                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
	                            <div class="col-md-6">
	                                <input id="name" v-model="user.name" type="text" class="form-control" required autofocus>
	                                <ul v-if="errors.name">
                                		<li v-for="error in errors.name" class="text-danger">{{ error }}</li>
                                	</ul>
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
	                            <div class="col-md-6">
	                                <input id="email" type="user.email" class="form-control" v-model="user.email" required>
									<ul v-if="errors.email">
                                		<li v-for="error in errors.email" class="text-danger">{{ error }}</li>
                                	</ul>	                            
                                </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
	                            <div class="col-md-6">
	                                <input id="password" type="password" class="form-control" v-model="user.password" required>
									<ul v-if="errors.password">
                                		<li v-for="error in errors.password" class="text-danger">{{ error }}</li>
                                	</ul>
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
	                            <div class="col-md-6">
	                                <input id="password-confirm" type="password" class="form-control" v-model="user.password_confirmation" required>
	                            </div>
	                            <ul v-if="errors.password_confirmation">
                                	<li v-for="error in errors.confirmation" class="text-danger">{{ error }}</li>
                            	</ul>
	                        </div>
	                        
	                        <div class="form-group row mb-0">
	                            <div class="col-md-6 offset-md-4">
	                                <button @click.prevent="register" class="btn btn-primary">Register</button>
	                            </div>
	                        </div>
	                    </form>
	                </div>
	            </div>
</template>

<script>
	export default{
		data(){
			return{
				errors:[],
				user:{
					name:'',
					email:'',
					password:'',
					password_confirmation:''
				}
			}
		},
		methods:{
			register(){
				axios.post('/register/',this.user)
					 .then((response)=>{
					 	this.$store.dispatch('setUser',this.user);
					 	this.$router.push('home');
					 	location.reload();
					 })
					 .catch((error)=> this.errors = error.data.response.errors);
			}
		}
	}
</script>