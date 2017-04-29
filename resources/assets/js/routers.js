// import Dashboard from './views/Dashboard.vue'
import VueRouter from 'vue-router';

let routes =[
      {
				path: '/',
				redirect:'/1'
			},
			{
				path: '/3',
				component: require('./components/map.vue')
			},
      {
				path: '/1',
				component: require('./components/upload.vue')
			},
      {
				path: '/2',
				component: require('./components/video.vue')
			},
];


export default new VueRouter({
	routes
})
