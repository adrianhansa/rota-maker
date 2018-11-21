<template>
	<div>
		<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <a class="navbar-brand" href="/">RotaMaker</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                        <li class="nav-item" v-if="user.admin">
                            <router-link :to="{name: 'home'}" class="nav-link">Home</router-link>
                        </li>
                        <li class="nav-item" v-if="user.admin">
                            <router-link  :to="{name: 'company.edit', params:{id:company.id}}" class="nav-link">Company edit</router-link>
                        </li>
                        <li class="nav-item" v-if="user.admin && !company.name">
                            <router-link :to="{name: 'company.create'}" class="nav-link">New Company</router-link>
                        </li>
                        <li class="nav-item" v-if="user.admin">
                            <router-link :to="{name: 'users.index'}" class="nav-link">Users</router-link>
                        </li>
                        <li class="nav-item" v-if="user.admin">
                            <router-link :to="{name: 'houses.index'}" class="nav-link">Houses</router-link>
                        </li>
                        <li class="nav-item" v-if="user.admin">
                            <router-link :to="{name: 'houses.create'}" class="nav-link">Add House</router-link>
                        </li>
                        <!--<li class="nav-item">
                            <router-link :to="{name: 'employees.index'}" class="nav-link">Employees</router-link>
                        </li>-->
                    </ul>
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><slot></slot><span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <!--<router-link :to="{name: 'logout'}" class="dropdown-item">Logout</router-link>-->
                                <a href="#" class="dropdown-item" @click.prevent="logout">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
        </nav>
	</div>
</template>

<script>
import {mapGetters} from 'vuex'
import {mapActions} from 'vuex'
   export default{
        props:['user'],
        methods:{
            logout(){
                axios.post('/logout')
                     .then((response)=>{
                        this.$router.push('/home');
                        location.reload();
                     })
                     .catch((error)=>console.log(error));
            },
            ...mapActions(['getCompany'])
        },
        computed:{
            ...mapGetters(['company'])
        },
        created(){
            this.$store.dispatch('getCompany');//.getCompany();
            this.$store.dispatch('setUser',this.user);
        }
    }
</script>