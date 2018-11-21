<template>
	<div class="row mt-2">
		<div class="col-sm-4 col-md-4 col-lg-4" v-for="house in houses" :key="house.id">
			<house-details :house="house" class="mb-2"></house-details>
		</div>
	</div>
</template>

<script>
	import {mapActions} from 'vuex'
	import {mapGetters} from 'vuex'
	import HouseDetails from './HouseDetails.vue'

	export default{
		computed:{
			...mapGetters(['houses'])
		},
		methods:{
			...mapActions(['getHouses'])
		},
		created(){
			this.$store.dispatch('getHouses');
		},
		components:{
			HouseDetails
		}
	} 
</script>