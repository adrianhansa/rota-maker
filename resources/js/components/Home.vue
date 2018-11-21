<template>
    <div class="mt-2">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-body">
                        <h2 v-show="user.name">Welcome, {{ user.name }}!</h2>
                        <p v-if="company.name"><router-link :to="{ name:'company.edit',params:{id:company.id} }">{{ company.name }}</router-link></p>
                        <p v-else><router-link :to="{name: 'company.create'}">Create a company</router-link></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex'
import {mapGetters} from 'vuex'

export default {
    computed:{
        ...mapGetters(['user','company'])
    },
    methods:{
        ...mapActions(['hello','getCompany'])
    },
    created(){
        this.getCompany();
        if(!this.user.admin && this.user.house_slug){
            this.$router.push({ name: 'house.dashboard', params: { house: this.user.house_slug }})
        }
    }
}
</script>
