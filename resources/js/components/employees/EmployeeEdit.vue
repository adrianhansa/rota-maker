<template>
	<div class="row justify-content-center mt-2">
        <div class="col-lg-4 col-md-6 col-sm-8">
            <div class="card">
                <div class="card-header">Add Staff Member</div>
                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <div class="col-5">
                                <label>Name</label>
                            </div>
                            <div class="col-7">
                                <input type="text" class="form-control" v-model="employee.name" required autofocus>
                                <ul v-if="errors.name">
                              	     <li v-for="error in errors.name" class="text-danger">{{ error }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-5">
                                <label for="position">Position</label>
                            </div>
                            <div class="col-7">
                                <select class="form-control" v-model="employee.position">
                                    <option></option>
                                    <option v-for="position in positions" :value="position">{{ position }}</option>
                                </select>
                                <ul v-if="errors.position">
                                    <li v-for="error in errors.position" class="text-danger">{{ error }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-5">
                                <span>Contracted Hours</span>
                            </div>
                            <div class="col-7">
                                <input type="text" class="form-control" v-model="employee.contracted_hours" required>
                                <ul v-if="errors.contracted_hours">
                                   <li v-for="error in errors.contracted_hours" class="text-danger">{{ error }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-5">
                                <span>Gender:</span>
                            </div>
                            <div class="col-7">
                                <span class="mr-5"><input type="radio" v-model="employee.gender" value="male">Male</span>
                                <input type="radio" v-model="employee.gender" value="female">Female
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-5">
                                <span>Drive</span>
                            </div>
                            <div class="col-7">
                                <span class="mr-5"><input type="radio" v-model="employee.driver" value="1">Yes</span>
                                <input type="radio" v-model="employee.driver" value="0">No
                                <ul v-if="errors.driver">
                                    <li v-for="error in errors.driver" class="text-danger">{{ error }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-5">
                                <span>Medi trained</span>
                            </div>
                            <div class="col-7">
                                <span class="mr-5"><input type="radio" v-model="employee.medi_trained" value="1">Yes</span>
                                <input type="radio" v-model="employee.medi_trained" value="0">No
                                <ul v-if="errors.medi_trained">
                                    <li v-for="error in errors.medi_trained" class="text-danger">{{ error }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-5">
                                <span>Can run shifts</span>
                            </div>
                            <div class="col-7">
                                <span class="mr-5"><input type="radio" v-model="employee.can_run_shifts" value="1">Yes</span>
                                <input type="radio" v-model="employee.can_run_shifts" value="0">No
                                <ul v-if="errors.driver">
                                    <li v-for="error in errors.can_run_shifts" class="text-danger">{{ error }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <button @click.prevent="updateEmployee" class="btn btn-primary">Save</button>
                            <router-link :to="{name: 'rota.dashboard',params:{house:$route.params.house}}" class="btn btn-secondary">Cancel</router-link>
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
            ...mapGetters(['positions','errors','gender','employee','house'])
        },
        methods:{
			updateEmployee(){
				this.$store.dispatch('updateEmployee',this.employee);
                this.$router.push({name:'rota.dashboard',params:{house:this.$route.params.house}});
			}
		},
        created(){
            this.$store.dispatch('getEmployee',this.$route.params.slug);
            this.$store.dispatch('getHouse',this.$route.params.house);
        }
	}
</script>