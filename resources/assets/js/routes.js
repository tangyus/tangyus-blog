import Admin from './views/Admin.vue';

export default [
	{
		path: '/admin',
		component: Admin,
		children: [
			{
				path: '/',
				redirect: '/admin/index',
			},
			{
				path: 'index',
				component: Admin,
			},
		]
	}
];