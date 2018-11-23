<template>
	<div class="row justify-content-center mt-3">
        <div class="col-sm-10 col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header bg-success text-white">Edit House Details</div>
                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" v-model="house.name" required autofocus>
                                <ul v-if="errors.name">
                                	<li v-for="error in errors.name" class="text-danger">{{ error }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" v-model="house.address" required>
                                <ul v-if="errors.address">
                                	<li v-for="error in errors.address" class="text-danger">{{ error }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button @click.prevent="updateHouse" class="btn btn-sm btn-primary">Save</button>
                                <router-link :to="{name: 'houses.index'}" class="btn btn-sm btn-secondary">Cancel</router-link>
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
            ...mapGetters(['house','errors'])
        },
		methods:{
            updateHouse(){
                this.$store.dispatch('updateHouse',this.house);
                this.$router.push({name:'houses.index'});
            }
		},
		created(){
			this.$store.dispatch('getHouse',this.$route.params.slug);
			console.log(this.house);
		}
	}
</script>
