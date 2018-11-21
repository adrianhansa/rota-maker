import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
	state:{
		user:{},
		user_for_edit:{},
		users:[],
		company:{},
		errors:[],
		houses:[],
		house:{},
		positions:['support worker','night support worker','team leader','cook','administrator','cleaner','manager','deputy manager','handyman'],
		shifts:[{name: '', start: '', end: '',duration:0.00},
				{name: 'E', start: '8:00', end: '15:00',duration:7.00},
				{name: 'L', start: '15:00', end: '22:00',duration:7.00},
				{name: 'N', start: '22:00', end: '8:00',duration:10.00},
				{name: 'D', start: '8:00', end: '22:00',duration:14.00},
				{name: 'O', start: '', end: '',duration:0.00},
				{name: 'A', start: '', end: '',duration:0.00},
				{name: 'S', start: '', end: '',duration:0.00}],
		employee:{},
		employees:[],
		employeesByHouse:[],
		gender:['male','female'],
		daysSelected:[],
		genericShifts:[],
		existingShifts:[]
	},
	mutations:{
		setUser: (state,payload)=>{
			state.user = payload;
		},
		createCompany: (state,payload)=>{
			axios.post('/company/store',payload)
				 .then((response)=>{
				 	state.company = payload;
                    this.$router.push({name:'home'});
                    location.reload();
               }).catch((error)=> errors = error.response.errors);
		},
		updateCompany: (state,payload)=>{
			axios.put('/company/update/'+payload.id,payload)
				 .then((response)=>{
				 	state.company = payload;
               }).catch((error)=> errors = error.response.errors);
		},
		getCompany: (state)=>{
			axios.get('/company')
				 .then((response)=>state.company = response.data)
				 .catch((error)=>console.log(error));
		},
		deleteCompany: (state,payload)=>{
			axios.delete('/company/delete/'+payload.id)
				 .then((response)=>console.log(response))
				 .catch((error)=>console.log(error))
		},
		getHouses: state=>{
			axios.get('/houses')
				 .then((response)=>state.houses = response.data)
				 .catch((error)=>console.log(error));
		},
		getHouse: (state,payload)=>{
			axios.get('/houses/'+payload)
				 .then((response)=>state.house = response.data)
				 .catch((error)=>console.log(error));
		},
		createHouse: (state,payload)=>{
			axios.post('/houses/store',payload)
				 .then((response)=>state.house = response.data)
				 .catch((error)=>console.log(error))
		},
		deleteHouse: (state,payload)=>{
			axios.post('/houses/delete/'+payload)
				 .then((response)=>console.log(response))
				 .catch((error)=>console.log(error));
		},
		updateHouse: (state,payload)=>{
			axios.put('/houses/update/'+payload.slug,payload)
				 .then((response)=>state.house=response.data)
				 .catch((error)=>console.log(error));
		},
		createUser: (state,payload)=>{
			axios.post('/users/store',payload)
				 .then((response)=>console.log(response))
				 .catch((error)=>console.log(error));
		},
		getUsers: (state)=>{
			axios.get('/users')
				 .then((response)=>state.users = response.data)
				 .catch((error)=>console.log(error));
		},
		deleteUser: (state,payload)=>{
			axios.delete('/users/delete/'+payload)
				 .then((response)=>console.log(error))
				 .catch((error)=>console.log(error));
		},
		getUser: (state,payload)=>{
			axios.get('/users/'+payload)
				 .then((response)=>state.user_for_edit=response.data)
				 .catch((error)=>console.log(error));
		},
		updateUser: (state,payload)=>{
			axios.put('/users/update/'+payload.id,payload)
				 .then((response)=>console.log(response))
				 .catch((error)=>console.log(error));
		},
		getEmployeesByHouse: (state,payload)=>{
			axios.get('/employees/'+payload)
				 .then((response)=>state.employeesByHouse = response.data)
				 .catch((error)=>console.log(error))
		},
		deleteEmployee: (state,payload)=>{
			axios.post('/employees/delete/'+payload,payload)
				 .then((response)=>console.log(response))
				 .catch((error)=>console.log(error));
		},
		getEmployee: (state,payload)=>{
			axios.get('/employees/details/'+payload)
				 .then((response)=>state.employee = response.data)
				 .catch((error)=>console.log(error));
		},
		updateEmployee: (state,payload)=>{
			axios.put('/employees/update/'+payload.slug,payload)
				 .then((response)=>console.log(response))
				 .catch((error)=>console.log(error));
		},
		getDaysSelected: (state,payload)=>{
			axios.get('/daysSelected/'+payload.house+'/'+payload.start+'/'+payload.end)
				 .then((response)=>{
				 	state.daysSelected=response.data.days;
				 	state.existingShifts=response.data.shifts;
				 	console.log(state.existingShifts);
				 	console.log(state.daysSelected);
				 })
				 .catch((error)=>console.log(error));
		},
		createShift: (state,payload)=>{
			axios.post('/createShift',payload)
				 // .then((response)=>{
				 // })
				 .catch((error)=>console.log(error));
		},
		getGenericShifts: (state,payload)=>{
			axios.get('/getGenericShifts/'+payload)
				 .then((response)=>state.genericShifts = response.data)
				 .catch((error)=>console.log(error));
		}
	},
	actions:{
		setUser: (context,payload)=>{
			context.commit('setUser',payload);
		},
		createCompany: (context,payload)=>{
			context.commit('createCompany',payload);
		},
		updateCompany: (context,payload)=>{
			context.commit('updateCompany',payload);
		},
		getCompany: (context)=>{
			context.commit('getCompany');
		},
		deleteCompany: (context,payload) => {
			context.commit('deleteCompany',payload);
		},
		getHouses: (context)=>{
			context.commit('getHouses');
		},
		getHouse: (context,payload)=>{
			context.commit('getHouse',payload);
		},
		createHouse: (context,payload)=>{
			context.commit('createHouse',payload);
		},
		deleteHouse: (context,payload)=>{
			context.commit('deleteHouse',payload);
		},
		updateHouse: (context,payload)=>{
			context.commit('updateHouse',payload);
		},
		createUser: (context,payload)=>{
			context.commit('createUser',payload);
		},
		getUsers: (context)=>{
			context.commit('getUsers');
		},
		deleteUser: (context,payload)=>{
			context.commit('deleteUser',payload);
		},
		getUser: (context,payload)=>{
			context.commit('getUser',payload);
		},
		updateUser: (context,payload)=>{
			context.commit('updateUser',payload);
		},
		getEmployeesByHouse: (context,payload)=>{
			context.commit('getEmployeesByHouse',payload);
		},
		deleteEmployee: (context,payload)=>{
			context.commit('deleteEmployee',payload);
		},
		getEmployee: (context,payload)=>{
			context.commit('getEmployee',payload);
		},
		updateEmployee: (context,payload)=>{
			context.commit('updateEmployee',payload);
		},
		getDaysOfTheYear: (context,payload)=>{
			context.commit('getDaysOfTheYear',payload);
		},
		getDaysSelected: (context,payload)=>{
			context.commit('getDaysSelected',payload);
		},
		createShift: (context,payload)=>{
			context.commit('createShift',payload);
		},
		getGenericShifts: (context,payload)=>{
			context.commit('getGenericShifts',payload);
		}
	},
	getters:{
		user: state=>{
			return state.user;
		},
		company: state=>{
			return state.company;
		},
		errors: state=>{
			return state.errors;
		},
		houses: state=>{
			return state.houses;
		},
		house: state=>{
			return state.house;
		},
		positions: state=>{
			return state.positions;
		},
		shifts: state=>{
			return state.shifts;
		},
		gender: state=>{
			return state.gender;
		},
		users: state=>{
			return state.users;
		},
		getUser: state=>{
			return state.user_for_edit
		},
		employeesByHouse: state=>{
			return state.employeesByHouse;
		},
		employee: state=>{
			return state.employee;
		},
		daysSelected: state=>{
			return state.daysSelected;
		},
		existingShifts: state=>{
			return state.existingShifts;
		},
		genericShifts: state=>{
			return state.genericShifts;
		}
	}
})