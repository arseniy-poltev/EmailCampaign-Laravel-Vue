import Vue from 'vue'
import Vuex from 'vuex'
import Alert from './modules/alert'
import ChangePassword from './modules/change_password'
import ChangeProfile from './modules/change_profile'
import Rules from './modules/rules'

import CampaignsIndex from './user-modules/Campaigns'
import CampaignsSingle from './user-modules/Campaigns/single'

import Invoice from './user-modules/Campaigns/invoice'
import InvoicesIndex from './user-modules/Invoices/index'

import SideBar from './sidebar'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        Alert,
        ChangePassword,
        Rules,
        CampaignsIndex,
        CampaignsSingle,
        Invoice,
        InvoicesIndex,
        SideBar,
        ChangeProfile
    },
    strict: debug,
})