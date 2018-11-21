<template>
	<div class="row justify-content-center mt-2">
        <div class="col-lg-4 col-md-6 col-sm-8">
	        <div class="card">
	        		<div class="card-header">Edit User</div>
	                <div class="card-body">
	                    <form>
	                        <div class="form-group row">
	                            <div class="col-5">
	                                <label>Name</label>
	                            </div>
	                            <div class="col-7">
	                                <input type="text" class="form-control" v-model="getUser.name" required autofocus>
	                                <ul v-if="errors.name">
	                              	     <li v-for="error in errors.name" class="text-danger">{{ error }}</li>
	                                </ul>
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <div class="col-5">
	                                <label>Email</label>
	                            </div>
	                            <div class="col-7">
	                                <input type="email" class="form-control" v-model="getUser.email" required>
	                                <ul v-if="errors.email">
	                              	     <li v-for="error in errors.email" class="text-danger">{{ error }}</li>
	                                </ul>
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <div class="col-5">
	                                <label for="position">House</label>
	                            </div>
	                            <div class="col-7">
	                                <select class="form-control" v-model="getUser.house_id">
	                                    <option></option>
	                                    <option v-for="house in houses" :value="house.id">{{ house.name }}</option>
	                                </select>
	                                <ul v-if="errors.house_id">
	                                    <li v-for="error in errors.house_id" class="text-danger">{{ error }}</li>
	                                </ul>
	                            </div>
	                        </div>

	                        <div class="form-group row">
                            <div class="col-5">
                                <span>Administrator rights</span>
                            </div>
                            <div class="col-7">
                                <span class="mr-5"><input type="radio" v-model="getUser.admin" value="1">Yes</span>
                                <input type="radio" v-model="getUser.admin" value="0">No
                                <ul v-if="errors.driver">
                                    <li v-for="error in errors.driver" class="text-danger">{{ error }}</li>
                                </ul>
                            </div>
                        </div>

	                        <div class="form-group row mb-0">
	                            <div class="col-md-6 offset-md-4">
	                                <button @click.prevent="updateUser" class="btn btn-sm btn-success">Update</button>
	                                <router-link :to="{name: 'users.index'}" class="btn btn-secondary btn-sm">Cancel</router-link>
	                            </div>
	                        </div>
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
			...mapGetters(['getUser','errors','houses'])
		},
		methods:{
			updateUser(){
				this.$store.dispatch('updateUser',this.getUser);
			 	this.$router.push({name:'users.index'});
			}
		},
		created(){
			this.$store.dispatch('getUser',this.$route.params.id);
			this.$store.dispatch('getHouses');	
		}
	}
</script>