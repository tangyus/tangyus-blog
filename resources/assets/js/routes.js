import Admin from './views/Admin.vue';
import Parent from './views/Parent.vue';

/* Users components */
import UserIndex from './views/user/Index.vue';
import UserCreate from './views/user/Create.vue';
import UserEdit from './views/user/Edit.vue';

/* Articles components */
import ArticleIndex from './views/article/Article.vue';
import ArticleEdit from './views/article/Edit.vue';
import ArticleCreate from './views/article/Create.vue';

/* Categories components */
import CategoryIndex from './views/category/Category.vue';
import CategoryEdit from './views/category/Edit.vue';
import CategoryCreate from './views/category/Create.vue';

/* Tags components */
import TagIndex from './views/tag/Tag.vue';
import TagEdit from './views/tag/Edit.vue';
import TagCreate from './views/tag/Create.vue';

/* Links components */
import LinkIndex from './views/link/Link.vue';
import LinkEdit from './views/link/Edit.vue';
import LinkCreate from './views/link/Create.vue';

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
			},
			{
				path: 'articles',
				component: Parent,
				children: [
					{
						path: '/',
						component: ArticleIndex
					},
					{
						path: 'create',
						component: ArticleCreate
					},
					{
						path: ':id/edit',
						component: ArticleEdit
					},
				]
			},
            {
                path: 'categories',
                component: Parent,
                children: [
                    {
                        path: '/',
                        component: CategoryIndex
                    },
                    {
                        path: 'create',
                        component: CategoryCreate
                    },
                    {
                        path: 'edit',
                        component: CategoryEdit
                    },
                ]
            },
            {
                path: 'tags',
                component: Parent,
                children: [
                    {
                        path: '/',
                        component: TagIndex
                    },
                    {
                        path: 'create',
                        component: TagCreate
                    },
                    {
                        path: 'edit',
                        component: TagEdit
                    },
                ]
            },
            {
                path: 'links',
                component: Parent,
                children: [
                    {
                        path: '/',
                        component: LinkIndex
                    },
                    {
                        path: 'create',
                        component: LinkCreate
                    },
                    {
                        path: 'edit',
                        component: LinkEdit
                    },
                ]
            }
		]
	}
];