import { createRouter, createWebHistory } from 'vue-router'
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
    component: Home
  },
  //notícias
  {
    path: '/news-create',
    name: 'NewsCreate',
    component: NewsCreate,
  },
  {
    path: '/news-list',
    name: 'NewsList',
    component: NewsList
  },
  {
    path: '/news-edit/:id',
    name: 'NewsEdit',
    component: NewsEdit,
    props: true
  },
  //categorias
  {
    path: '/categories-create',
    name: 'CategoriesCreate',
    component: CategoriesCreate
  },
  {
    path: '/categories-list',
    name: 'CategoriesList',
    component: CategoriesList
  },
  {
    path: '/categories-edit/:id',
    name: 'CategoriesEdit',
    component: CategoriesEdit,
    props: true
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

export default router
