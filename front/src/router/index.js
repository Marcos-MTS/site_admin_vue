import { createRouter, createWebHistory } from 'vue-router'

import store from "../store";

import Home from '../views/Home.vue'
//notícias
import NewsCreate from '../views/news/Create'
import NewsList from '../views/news/List'
import NewsEdit from '../views/news/Edit'
//categorias
import CategoriesCreate from '../views/categories/Create'
import CategoriesList from '../views/categories/List'
import CategoriesEdit from '../views/categories/Edit'
//Login
import Login from '../views/login/login'
//Usuários
import UsersCreate from '../views/users/Create'
import UsersList from '../views/users/List'
import UsersEdit from '../views/users/Edit'
//Perfis de Usuários
import UsersLevelCreate from '../views/usersLevel/Create'
import UsersLevelList from '../views/usersLevel/List'
import UsersLevelEdit from '../views/usersLevel/Edit'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
    beforeEnter: isAuth,
  },
  //notícias
  {
    path: '/news-create',
    name: 'NewsCreate',
    component: NewsCreate,
    beforeEnter: isAuth,
  },
  {
    path: '/news-list',
    name: 'NewsList',
    component: NewsList,
    beforeEnter: isAuth,
  },
  {
    path: '/news-edit/:id',
    name: 'NewsEdit',
    component: NewsEdit,
    props: true,
    beforeEnter: isAuth,
  },
  //categorias
  {
    path: '/categories-create',
    name: 'CategoriesCreate',
    component: CategoriesCreate,
    beforeEnter: isAuth,
  },
  {
    path: '/categories-list',
    name: 'CategoriesList',
    component: CategoriesList,
    beforeEnter: isAuth,
  },
  {
    path: '/categories-edit/:id',
    name: 'CategoriesEdit',
    component: CategoriesEdit,
    props: true,
    beforeEnter: isAuth,
  },
  //Login
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  //usuários
  {
    path: '/users-create',
    name: 'UsersCreate',
    component: UsersCreate,
    beforeEnter: isAuth,
  },
  {
    path: '/users-list',
    name: 'UsersList',
    component: UsersList,
    beforeEnter: isAuth,
  },
  {
    path: '/users-edit/:id',
    name: 'UsersEdit',
    component: UsersEdit,
    props: true,
    beforeEnter: isAuth,
  },
  //perfis de usuários
  {
    path: '/users-level-create',
    name: 'UsersLevelCreate',
    component: UsersLevelCreate,
    beforeEnter: isAuth,
  },
  {
    path: '/users-level-list',
    name: 'UsersLevelList',
    component: UsersLevelList,
    beforeEnter: isAuth,
  },
  {
    path: '/users-level-edit/:id',
    name: 'UsersLevelEdit',
    component: UsersLevelEdit,
    props: true,
    beforeEnter: isAuth,
  },

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

//apenas verifica se existe um token, a validação real do token é no back end
function isAuth(to, from, next) {

  if (store.state.token) {
    next();
  }
  else {
    next('/login');
  }
}

export default router
