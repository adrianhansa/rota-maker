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
                                <input type="text" class="form-control" v-model="staff.name" required autofocus>
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
                                <select class="form-control" v-model="staff.position">
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
                                <input type="text" class="form-control" v-model="staff.contracted_hours" required>
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
                                <span class="mr-5"><input type="radio" v-model="staff.gender" value="male">Male</span>
                                <input type="radio" v-model="staff.gender" value="female">Female
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-5">
                                <span>Drive</span>
                            </div>
                            <div class="col-7">
                                <span class="mr-5"><input type="radio" v-model="staff.driver" value="1">Yes</span>
                                <input type="radio" v-model="staff.driver" value="0">No
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
                                <span class="mr-5"><input type="radio" v-model="staff.medi_trained" value="1">Yes</span>
                                <input type="radio" v-model="staff.medi_trained" value="0">No
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
                                <span class="mr-5"><input type="radio" v-model="staff.can_run_shifts" value="1">Yes</span>
                                <input type="radio" v-model="staff.can_run_shifts" value="0">No
                                <ul v-if="errors.driver">
                                    <li v-for="error in errors.can_run_shifts" class="text-danger">{{ error }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <button @click.prevent="addStaff" class="btn btn-primary">Save</button>
                            <router-link :to="{name: 'employeesByHouse',params:{house:$route.params.house}}" class="btn btn-secondary">Cancel</router-link>
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
            ...mapGetters(['positions','errors','gender','user'])
        },
		data(){
			return{
				staff:{
					name:'',
                    house_id:this.$route.params.house,
					position:'',
                    contracted_hours:0,
                    gender:'male',
                    medi_trained:0,
                    driver:0,
                    can_run_shifts:0
				}
            }
		},
		methods:{
			addStaff(){
				axios.post('/employees/store/',this.staff)
					 .then((response)=>{
                        this.$router.push({name:'employeesByHouse',params:{house:this.$route.params.house}});
                    }).catch((error)=> console.log(error));//this.errors = error.response);
			}
		},
        created(){
            console.log(this.$route.params);
        }
	}
</script>