import Vue from 'vue'
import VueRouter from 'vue-router'

import ChangePassword from '../components/ChangePassword.vue'

import CampaignsIndex from '../components/user/cruds/Campaigns/Index.vue'
import CampaignsCreate from '../components/user/cruds/Campaigns/Create.vue'
import CampaignsShow from '../components/user/cruds/Campaigns/Show.vue'
import CampaignsEdit from '../components/user/cruds/Campaigns/Edit.vue'
import CampaignsPayment from '../components/user/cruds/Campaigns/Payment.vue'

import FilterPage from '../components/user/FilterPage.vue'
import InvoicePage from '../components/user/InvoicePage.vue'
import Dashboard from '../components/user/Dashboard.vue'

import ChangeProfile from '../components/ChangeProfile.vue'


Vue.use(VueRouter)

const routes = [
    { path: '/change-password', component: ChangePassword, name: 'auth.change_password' },
    { path: '/change-profile', component: ChangeProfile, name: 'auth.change_profile' },

    //*************for campaign**************/
    { path: '/campaigns', component: CampaignsIndex, name: 'campaigns.index' },

    { path: '/campaigns/setup', component: CampaignsCreate, name: 'campaigns.setup' },
    { path: '/campaigns/filter', component: FilterPage, name: 'campaigns.filter' },

    { path: '/campaigns/:id', component: CampaignsShow, name: 'campaigns.show' },

    { path: '/campaigns/:id/edit/filter', component: FilterPage, name: 'campaigns.edit.filter' },
    { path: '/campaigns/:id/edit/setup', component: CampaignsEdit, name: 'campaigns.edit.setup' },
    { path: '/campaigns/:id/edit', redirect: { name: 'campaigns.edit.filter' }, name: 'campaigns.edit' },

    { path: '/campaigns/:id/pay', component: CampaignsPayment, name: 'campaigns.pay' },

    { path: '/invoice', component: InvoicePage, name: 'invoice' },

    { path: '/dashboard', component: Dashboard, name: 'dashboard' },
]

export default new VueRouter({
    mode: 'history',
    base: '/backend',
    routes
})