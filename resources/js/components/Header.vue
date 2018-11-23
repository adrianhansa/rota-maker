<template>
	<div>
			  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom mr-0">
			    <ul class="nav navbar-nav">
			      <li class="nav-item">
			        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
			      </li>
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
			    </ul>

					<!-- Right Side Of Navbar -->

					<ul class="navbar-nav ml-auto">
							<li class="nav-item dropdown">
									<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><slot></slot><span class="caret"></span>
									</a>
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
											<a href="#" class="dropdown-item" @click.prevent="logout">Logout</a>
									</div>
							</li>
					</ul>
			  </nav>

			  <!-- Main Sidebar Container -->
			  <aside class="main-sidebar sidebar-dark-primary elevation-4">
			    <a href="/" class="brand-link text-center">
			      <span class="brand-text font-weight-light mt-3">Rota Creator</span>
			    </a>
			    <div class="sidebar">
			      <nav class="mt-1">
			        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			          <li class="nav-item has-treeview menu-open">
			            <a href="#" class="nav-link active">
			              <i class="nav-icon fa fa-dashboard"></i>
			              <p>
			                Starter Pages
			                <i class="right fa fa-angle-left"></i>
			              </p>
			            </a>
			            <ul class="nav nav-treeview">
			              <li class="nav-item">
			                <a href="#" class="nav-link active">
			                  <i class="fa fa-circle-o nav-icon"></i>
			                  <p>Active Page</p>
			                </a>
			              </li>
			              <li class="nav-item">
			                <a href="#" class="nav-link">
			                  <i class="fa fa-circle-o nav-icon"></i>
			                  <p>Inactive Page</p>
			                </a>
			              </li>
			            </ul>
			          </li>
			          <li class="nav-item">
			            <a href="#" class="nav-link">
			              <i class="nav-icon fa fa-th"></i>
			              <p>
			                Simple Link
			                <span class="right badge badge-danger">New</span>
			              </p>
			            </a>
			          </li>
			        </ul>
			      </nav>
			    </div>
			  </aside>
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
