import Vue from 'vue'
import Vuex from 'vuex'
import Alert from './modules/alert'
import ChangePassword from './modules/change_password'
import ChangeProfile from './modules/change_profile'
import Rules from './modules/rules'
import PermissionsIndex from './admin-modules/Permissions'
import PermissionsSingle from './admin-modules/Permissions/single'
import RolesIndex from './admin-modules/Roles'
import RolesSingle from './admin-modules/Roles/single'
import UsersIndex from './admin-modules/Users'
import UsersSingle from './admin-modules/Users/single'
import CampaignsIndex from './admin-modules/Campaigns'
import CampaignsSingle from './admin-modules/Campaigns/single'
import CountriesIndex from './admin-modules/Countries'
import CountriesSingle from './admin-modules/Countries/single'
import CurrenciesIndex from './admin-modules/Currencies'
import CurrenciesSingle from './admin-modules/Currencies/single'
import CitiesIndex from './admin-modules/Cities'
import CitiesSingle from './admin-modules/Cities/single'
import InvoicesIndex from './admin-modules/Invoices/index'
import InvoicesSingle from './admin-modules/Invoices/single'
import TopicsIndex from './admin-modules/Topics/index'
import TopicsSingle from './admin-modules/Topics/single'
import FilterKeysIndex from './admin-modules/FilterKeys/index'
import FilterKeysSingle from './admin-modules/FilterKeys/single'
import KeyAnswersIndex from './admin-modules/KeyAnswers/index'
import KeyAnswersSingle from './admin-modules/KeyAnswers/single'
import LanguagesIndex from './admin-modules/Languages'
import LanguagesSingle from './admin-modules/Languages/single'
import SideBar from './sidebar'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        Alert,
        ChangePassword,
        ChangeProfile,
        Rules,
        PermissionsIndex,
        PermissionsSingle,
        RolesIndex,
        RolesSingle,
        UsersIndex,
        UsersSingle,
        CampaignsIndex,
        CampaignsSingle,
        CountriesIndex,
        CountriesSingle,
        CurrenciesIndex,
        CurrenciesSingle,
        CitiesIndex,
        CitiesSingle,
        InvoicesIndex,
        InvoicesSingle,
        TopicsIndex,
        TopicsSingle,
        FilterKeysIndex,
        FilterKeysSingle,
        KeyAnswersIndex,
        KeyAnswersSingle,
        LanguagesIndex,
        LanguagesSingle,
        SideBar
    },
    strict: debug,
})