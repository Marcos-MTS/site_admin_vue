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
