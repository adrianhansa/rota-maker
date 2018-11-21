<template>
	<div class="row mt-2">
		<div class="col-12" id="results">
			<h2>ROTA for {{ house.name }}</h2>
				<v-date-picker
			  		mode='range'
			  		v-model='selectedDate'
			  		@input="getDaysSelected"
			  		show-caps>
				</v-date-picker> <a href="#" @click.prevent="getReport" class="btn btn-sm btn-secondary">Save as PDF</a>
			<div class="row">
				<div class="col-12">
					<table class="table table-striped small">
						<thead>
							<tr class="bg-info">
								<td class="text-right" colspan="5">
									<!--Total hours per day:<br>-->
									<span># Staff on Early:</span><br>
									<span># Staff on Late:</span><br>
									<span># Staff on Night:</span>
								</td>
								<td v-for="day in daysSelected">
									<!--H={{ hoursPerDay ? hoursPerDay[day.dayOfWeek]:'' }}<br>-->
									<span>{{ staffOnShift('E',day.date) + staffOnShift('D',day.date)}}</span><br>
									<span>{{ staffOnShift('L',day.date) + staffOnShift('D',day.date) }}</span><br>
									<span>{{ staffOnShift('N',day.date) }}</span>
								</td>
								<td></td>
							</tr>
							<tr class="bg-primary text-white">
								<th>Name</th>
								<th>Position</th>
								<th>H/W</th>
								<th>Driver</th>
								<th>Medi trained</th>
								<th v-for="day in daysSelected"><small>{{ day.dayOfWeek }}<br>{{ day.date }}</small></th>
								<th>Hours worked</th>	
							</tr>
						</thead>
						<tbody>

							<tr v-for="employee in employeesByHouse">
								<td><small><router-link :to="{name: 'employees.edit',params:{house:$route.params.house,slug:employee.slug}}">{{ employee.name }}</router-link></small></td>
								<td><small :class="{'text-success':employee.position=='team leader'}">{{ employee.position }}</small></td>
								<td><small>{{ employee.contracted_hours }}</small></td>
								<td><small>{{ employee.driver ? 'yes':'no' }}</small></td>
								<td><small>{{ employee.medi_trained ? 'yes':'no' }}</small></td>
								<td v-for="day in daysSelected">
									<select class="form-control" :class="{'text-success' : (employee.position == 'team leader')}" @change="updateShift(day,employee,$event.target.selectedOptions[0]._value)" required>
										<option 
											v-for="i in existingShifts"
											v-if="i.date===day.date && i.employee_id===employee.id" 
											:value="{id:i.shift_id,name:i.shift_name,duration:i.shift_duration}"
											selected>{{i.shift_name}}</option>
										<option v-for="shift in genericShifts" :value="shift">{{ shift.name }}</option>
									</select>
								</td>
								<td :class="{'text-danger':employee.contracted_hours < hoursPerWeekByEmployee[employee.slug]}">{{ hoursPerWeekByEmployee[employee.slug] }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import {mapGetters} from 'vuex'
	export default{
		data(){
			return{
				selectedDate:{
					start: new Date(),
        			end: new Date()
				},
				shiftsSelected:[],
				hoursPerWeekByEmployee:[],
				existingShifts:[],
				genericShifts:[],
				daysSelected:[],
				totalHoursPerDay:[],
				totalEmployeesPerShift:0,
			}
		},
		computed:{
			...mapGetters(['house','employeesByHouse']),
			eShifts(){
				return this.existingShifts;
			},
			hoursPerDay(){
				this.daysSelected.forEach(day=>{
					var totalHours = 0;
					this.existingShifts.forEach(item=>{
						if(day.date === item.date){
							totalHours += item.shift_duration;
							this.totalHoursPerDay[day.dayOfWeek] = totalHours;
						}
					})
				})
				return this.totalHoursPerDay;
			}
		},
		methods:{
			getReport(){
				var element = document.getElementById('results');
				var opt = {
				  margin: 15,
				  filename:'Rota.pdf',
				  jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
				};
				html2pdf(element, opt);
			},
			getDaysSelected(){
				this.hoursPerWeekByEmployee = [];
				var start = this.selectedDate.start.getTime()/1000;
				var end = this.selectedDate.end.getTime()/1000;
				//check if these days exist in the days table for this house and if not create them
				axios.get('/daysSelected/'+this.$route.params.house+'/'+start+'/'+end)
				 .then((response)=>{
				 	this.existingShifts=response.data.shifts;
				 	this.daysSelected=response.data.days;
				 	this.getHoursPerWeekByEmployee(this.existingShifts);
				 })
				 .catch((error)=>console.log(error));	 	
			},
			updateShift(date,employee,shift){
				axios.post('/createShift',{date:date,employee:employee,shift:shift})
					 .then((response)=>{
					 	this.updateExistingShifts({house:this.$route.params.house,days:this.daysSelected});
					 	this.getHoursPerWeekByEmployee(this.existingShifts);
					 })
					 .catch((error)=>console.log(error));
				return this.hoursPerWeekByEmployee;
			},
			updateExistingShifts(payload){
				axios.post('/existingShifts',payload)
				 .then((response)=>{
				 	this.existingShifts=response.data;
				 	this.getHoursPerWeekByEmployee(this.existingShifts);
				 })
				 .catch((error)=>console.log(error)); 
				 return this.hoursPerWeekByEmployee;
			},
			getHoursPerWeekByEmployee(existingShifts){	
					this.employeesByHouse.forEach(employee=>{
						var hours = 0;
						existingShifts.forEach(item=>{
							if(employee.id===item.employee_id){
								hours += item.shift_duration;
								this.hoursPerWeekByEmployee[employee.slug] = hours;	
							}
						})
					})
				return this.hoursPerWeek;
			},
			getGenericShifts(){
				axios.get('/getGenericShifts/'+this.$route.params.house)
				 	 .then((response)=>this.genericShifts = response.data)
				     .catch((error)=>console.log(error));
			},
			staffOnShift(shift,date){
				var data = this.existingShifts.filter(function(item){
					return item.shift_name == shift;
				}).filter(function(item){
					return item.date == date;
				});
				return data.length;
			}
		},
		created(){		
			this.$store.dispatch('getHouse',this.$route.params.house);
			this.$store.dispatch('getEmployeesByHouse',this.$route.params.house);
		},
		mounted(){
			this.getGenericShifts();
			this.getHoursPerWeekByEmployee(this.existingShifts);
		}
	}
</script>