<template>
	<div class="row justify-content-center mt-2">
        <div class="col-sm-10 col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header bg-success">Update Your Company</div>
                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" v-model="company.name" required autofocus>
                                <ul v-if="errors.name">
                                	<li v-for="error in errors.name" class="text-danger">{{ error }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" v-model="company.address" required>
                                <ul v-if="company.address">
                                	<li v-for="error in errors.address" class="text-danger">{{ error }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button @click.prevent="updateCompany" class="btn btn-sm btn-primary">Save</button>
                                <router-link :to="{name: 'home'}" class="btn btn-sm btn-secondary">Cancel</router-link>
                                <a href="#" class="btn btn-sm btn-danger" @click.prevent="del">Delete</a>
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
            ...mapGetters(['company','errors'])
        },
		methods:{
			updateCompany(){
				this.$store.dispatch('updateCompany',this.company);
                this.$router.push({name:'home'});
			},
            del(){
                this.$store.dispatch('deleteCompany',this.company);
                this.$router.push({name:'home'});
            }
		}
	}
</script>