import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import NewsCreate from '../views/news/Create'
import NewsList from '../views/news/List'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/news-create',
    name: 'NewsCreate',
   component : NewsCreate
  },
  {
    path: '/news-list',
    name: 'NewsList',
   component : NewsList
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
