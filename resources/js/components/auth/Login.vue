<template>
            <div class="card">
                <!--<div class="card-header">Login</div>-->

                <div class="card-body">
                    <form method="POST" action="" aria-label="Login">
						<div class="form-group row">
                            <div class="col-md-12">
                                <input type="email" class="form-control" v-model="user.email" placeholder="Email address" required autofocus>
                                <ul v-if="errors.email">
                                    <li class="text-danger" v-for="error in errors">{{ error }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="password" class="form-control" v-model="user.password" placeholder="Password" required>
                                <ul v-if="errors.password">
                                    <li class="text-danger" v-for="error in errors">{{ error }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" @click.prevent="login">Login</button>
                                <a class="btn btn-link" href="">Forgot Your Password ?</a>
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
                user:{
                    email:'',
                    password:''
                },
                errors:{}
            }
        },
        methods:{
            login(){
                axios.post('login',this.user)
                     .then((response)=>{
                        this.$router.push({name:'home'});
                        location.reload();
                     }).catch((error)=>this.errors = error.response.data.errors);
            }
        }
    }
</script>
