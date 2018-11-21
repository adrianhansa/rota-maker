import Welcome from './components/Welcome'
import Home from './components/Home'
import Register from './components/auth/Register'
import Login from './components/auth/Login'
import CompanyCreate from './components/company/CompanyCreate'
import CompanyEdit from './components/company/CompanyEdit'
import HouseCreate from './components/houses/HouseCreate'
import HouseEdit from './components/houses/HouseEdit'
import HouseDetails from './components/houses/HouseDetails'
import HouseList from './components/houses/HouseList'
import EmployeeCreate from './components/employees/EmployeeCreate'
import EmployeeEdit from './components/employees/EmployeeEdit'
//import EmployeeList from './components/employees/EmployeeList'
import EmployeesByHouse from './components/employees/EmployeesByHouse'
import UserDetails from './components/users/UserDetails'
import UserCreate from './components/users/UserCreate'
import UserEdit from './components/users/UserEdit'
import UserList from './components/users/UserList'
import RotaDashboard from './components/calendar/Dashboard'
import HouseDashboard from './components/houses/HouseDashboard'
import ShiftCreate from './components/shifts/ShiftCreate'
import ShiftEdit from './components/shifts/ShiftEdit'
import ShiftList from './components/shifts/ShiftList'

import {store} from './store/index'

export const routes = [
	//{path:'/', component:Welcome, name:'welcome'},
	{path:'/', component:Home, name:'home'},
	{path:'/register', component:Register, name:'register'},
	{path:'/login', component:Register, name:'login'},
	{path:'/company/create', component:CompanyCreate, name:'company.create',beforeEnter: (to,from,next)=> {store.getters.user.admin ? next():next('/')}},
	{path:'/company/edit/:id', component:CompanyEdit, name:'company.edit',beforeEnter: (to,from,next)=> {store.getters.user.admin ? next():next('/')}},
	{path:'/houses', component:HouseList, name:'houses.index',beforeEnter: (to,from,next)=> {store.getters.user.admin ? next():next('/')}},
	{path:'/houses/create', component:HouseCreate, name:'houses.create',beforeEnter: (to,from,next)=> {store.getters.user.admin ? next():next('/')}},
	{path:'/houses/edit/:slug', component:HouseEdit, name:'houses.edit',beforeEnter: (to,from,next)=> {store.getters.user.admin ? next():next('/')}},
	{path:'/houses/details/:slug', component:HouseDetails, name:'houses.details'},
	//{path:'/employees', component:EmployeeList, name:'employees.index'},
	{path:'/employees/:house', component:EmployeesByHouse, name:'employeesByHouse'},
	{path:'/employees/create/:house', component:EmployeeCreate, name:'employees.create'},
	{path:'/employees/edit/:house/:slug', component:EmployeeEdit, name:'employees.edit'},
	{path:'/users', component:UserList, name:'users.index',beforeEnter: (to,from,next)=> {store.getters.user.admin ? next():next('/')}},
	{path:'/users/create', component:UserCreate, name:'users.create',beforeEnter: (to,from,next)=> {store.getters.user.admin ? next():next('/')}},
	{path:'/users/edit/:id', component:UserEdit, name:'users.edit',beforeEnter: (to,from,next)=> {store.getters.user.admin ? next():next('/')}},
	{path:'/users/details/:id', component:UserDetails, name:'users.details',beforeEnter: (to,from,next)=> {store.getters.user.admin ? next():next('/')}},
	{path:'/:house/rota', component:RotaDashboard, name:'rota.dashboard'},
	{path:'/dashboard/:house', component:HouseDashboard, name:'house.dashboard'},
	{path:'/:house/shifts', component:ShiftList, name:'shifts.index'},
	{path:'/:house/shifts/create', component:ShiftCreate, name:'shifts.create'},
	{path:'/:house/shifts/edit/:id', component:ShiftEdit, name:'shifts.edit'},
]