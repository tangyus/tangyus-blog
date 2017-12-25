import Admin from './views/Admin.vue';
import Parent from './views/Parent.vue';

/* Users components */
import UserIndex from './views/user/Index.vue';
import UserCreate from './views/user/Create.vue';
import UserEdit from './views/user/Edit.vue';

export default [
	{
		path: '/admin',
		component: Admin,
		children: [
			{
				path: '/',
				redirect: '/admin/users'
			},
			{
				path: 'index',
				component: Admin
			},
			{
				path: 'users',
				component: Parent,
				children: [
					{
						path: '/',
						component: UserIndex
					},
					{
						path: 'create',
						component: UserCreate
					},
					{
						path: ':id/edit',
						component: UserEdit
					}
				]
			}
		]
	}
];