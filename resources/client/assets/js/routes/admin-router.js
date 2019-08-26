import Vue from 'vue'
import VueRouter from 'vue-router'

import ChangePassword from '../components/ChangePassword.vue'
import ChangeProfile from '../components/ChangeProfile.vue'
import PermissionsIndex from '../components/admin/cruds/Permissions/Index.vue'
import PermissionsCreate from '../components/admin/cruds/Permissions/Create.vue'
import PermissionsShow from '../components/admin/cruds/Permissions/Show.vue'
import PermissionsEdit from '../components/admin/cruds/Permissions/Edit.vue'
import RolesIndex from '../components/admin/cruds/Roles/Index.vue'
import RolesCreate from '../components/admin/cruds/Roles/Create.vue'
import RolesShow from '../components/admin/cruds/Roles/Show.vue'
import RolesEdit from '../components/admin/cruds/Roles/Edit.vue'
import UsersIndex from '../components/admin/cruds/Users/Index.vue'
import UsersCreate from '../components/admin/cruds/Users/Create.vue'
import UsersShow from '../components/admin/cruds/Users/Show.vue'
import UsersEdit from '../components/admin/cruds/Users/Edit.vue'
import CampaignsIndex from '../components/admin/cruds/Campaigns/Index.vue'
import CampaignsShow from '../components/admin/cruds/Campaigns/Show.vue'

import CountriesIndex from '../components/admin/cruds/Countries/Index.vue'
import CountriesCreate from '../components/admin/cruds/Countries/Create.vue'
import CountriesShow from '../components/admin/cruds/Countries/Show.vue'
import CountriesEdit from '../components/admin/cruds/Countries/Edit.vue'

import CurrenciesIndex from '../components/admin/cruds/Currencies/Index.vue'
import CurrenciesCreate from '../components/admin/cruds/Currencies/Create.vue'
import CurrenciesShow from '../components/admin/cruds/Currencies/Show.vue'
import CurrenciesEdit from '../components/admin/cruds/Currencies/Edit.vue'

import CitiesIndex from '../components/admin/cruds/Cities/Index.vue'
import CitiesCreate from '../components/admin/cruds/Cities/Create.vue'
import CitiesShow from '../components/admin/cruds/Cities/Show.vue'
import CitiesEdit from '../components/admin/cruds/Cities/Edit.vue'

import TopicsIndex from '../components/admin/cruds/Topics/Index.vue'
import TopicsCreate from '../components/admin/cruds/Topics/Create.vue'
import TopicsShow from '../components/admin/cruds/Topics/Show.vue'
import TopicsEdit from '../components/admin/cruds/Topics/Edit.vue'

import FilterKeysIndex from '../components/admin/cruds/FilterKeys/Index.vue'
import FilterKeysCreate from '../components/admin/cruds/FilterKeys/Create.vue'
import FilterKeysShow from '../components/admin/cruds/FilterKeys/Show.vue'
import FilterKeysEdit from '../components/admin/cruds/FilterKeys/Edit.vue'

import KeyAnswersIndex from '../components/admin/cruds/KeyAnswers/Index.vue'
import KeyAnswersCreate from '../components/admin/cruds/KeyAnswers/Create.vue'
import KeyAnswersShow from '../components/admin/cruds/KeyAnswers/Show.vue'
import KeyAnswersEdit from '../components/admin/cruds/KeyAnswers/Edit.vue'

import LanguagesIndex from '../components/admin/cruds/Languages/Index.vue'
import LanguagesCreate from '../components/admin/cruds/Languages/Create.vue'
import LanguagesShow from '../components/admin/cruds/Languages/Show.vue'
import LanguagesEdit from '../components/admin/cruds/Languages/Edit.vue'

import Dashboard from '../components/admin/Dashboard.vue'
import InvoicesIndex from '../components/admin/Invoices/Index.vue'
import InvoicesShow from '../components/admin/Invoices/Show.vue'

Vue.use(VueRouter)

const routes = [
    { path: '/change-password', component: ChangePassword, name: 'auth.change_password' },
    { path: '/change-profile', component: ChangeProfile, name: 'auth.change_profile' },
    //*************for permission**************/
    { path: '/permissions', component: PermissionsIndex, name: 'permissions.index' },
    { path: '/permissions/create', component: PermissionsCreate, name: 'permissions.create' },
    { path: '/permissions/:id', component: PermissionsShow, name: 'permissions.show' },
    { path: '/permissions/:id/edit', component: PermissionsEdit, name: 'permissions.edit' },

    //*************for role**************/
    { path: '/roles', component: RolesIndex, name: 'roles.index' },
    { path: '/roles/create', component: RolesCreate, name: 'roles.create' },
    { path: '/roles/:id', component: RolesShow, name: 'roles.show' },
    { path: '/roles/:id/edit', component: RolesEdit, name: 'roles.edit' },

    //*************for user**************/
    { path: '/users', component: UsersIndex, name: 'users.index' },
    { path: '/users/create', component: UsersCreate, name: 'users.create' },
    { path: '/users/:id', component: UsersShow, name: 'users.show' },
    { path: '/users/:id/edit', component: UsersEdit, name: 'users.edit' },

    //*************for country**************/
    { path: '/countries', component: CountriesIndex, name: 'countries.index' },
    { path: '/countries/create', component: CountriesCreate, name: 'countries.create' },
    { path: '/countries/:id', component: CountriesShow, name: 'countries.show' },
    { path: '/countries/:id/edit', component: CountriesEdit, name: 'countries.edit' },

    //*************for currency**************/
    { path: '/currencies', component: CurrenciesIndex, name: 'currencies.index' },
    { path: '/currencies/create', component: CurrenciesCreate, name: 'currencies.create' },
    { path: '/currencies/:id', component: CurrenciesShow, name: 'currencies.show' },
    { path: '/currencies/:id/edit', component: CurrenciesEdit, name: 'currencies.edit' },

    //*************for city**************/
    { path: '/country/:id/cities', component: CitiesIndex, name: 'cities.index' },
    { path: '/country/:id/:code/cities/create', component: CitiesCreate, name: 'cities.create' },
    { path: '/cities/:id', component: CitiesShow, name: 'cities.show' },
    { path: '/cities/:id/edit', component: CitiesEdit, name: 'cities.edit' },

    //*************for key topic**************/
    { path: '/topics', component: TopicsIndex, name: 'topics.index' },
    { path: '/topics/create', component: TopicsCreate, name: 'topics.create', meta: 'TopicsSingle' },
    { path: '/topics/:id', component: TopicsShow, name: 'topics.show' },
    { path: '/topics/:id/edit', component: TopicsEdit, name: 'topics.edit', meta: 'TopicsSingle' },

    //*************for filter key**************/
    { path: '/filter-keys', component: FilterKeysIndex, name: 'filter.keys.index' },
    { path: '/filter-keys/create', component: FilterKeysCreate, name: 'filter.keys.create', meta: 'TopicsSingle' },
    { path: '/filter-keys/:id', component: FilterKeysShow, name: 'filter.keys.show' },
    { path: '/filter-keys/:id/edit', component: FilterKeysEdit, name: 'filter.keys.edit', meta: 'TopicsSingle' },

    //*************for key answer**************/
    { path: '/filter-key/:id/key-answers', component: KeyAnswersIndex, name: 'key.answers.index' },
    { path: '/filter-key/:id/key-answers/create', component: KeyAnswersCreate, name: 'key.answers.create' },
    { path: '/key-answers/:id', component: KeyAnswersShow, name: 'key.answers.show' },
    { path: '/key-answers/:id/edit', component: KeyAnswersEdit, name: 'key.answers.edit' },

    //*************for language**************/
    { path: '/languages', component: LanguagesIndex, name: 'languages.index' },
    { path: '/languages/create', component: LanguagesCreate, name: 'languages.create' },
    { path: '/languages/:id', component: LanguagesShow, name: 'languages.show' },
    { path: '/languages/:id/edit', component: LanguagesEdit, name: 'languages.edit' },

    { path: '/campaigns', component: CampaignsIndex, name: 'campaigns.index' },
    { path: '/campaigns/:id', component: CampaignsShow, name: 'campaigns.show' },
    { path: '/dashboard', component: Dashboard, name: 'dashboard' },

    { path: '/invoices', component: InvoicesIndex, name: 'invoices.index' },
    { path: '/invoices/:id', component: InvoicesShow, name: 'invoices.show' },

    { path: '*', redirect: { name: 'dashboard' } },
]

export default new VueRouter({
    mode: 'history',
    base: '/admin',
    routes
})