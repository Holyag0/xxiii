import { createApp, h } from 'vue'
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import route from "ziggy-js";
import Layout from './Shared/Layout'
import convertFloatMoney from './utils/convertFloatMoney';
import convertMoneyFloat from './utils/convertMoneyFloat';
import valorPacote from './utils/valorPacote';
import money from 'v-money';
import convertData from './utils/convertData';
import { VueMask } from 'vue-the-mask'
import Notifications from '@kyvg/vue3-notification'
import getPermission from './utils/getPermission';
import getRole from './utils/getRole';


createInertiaApp({
    resolve: async name => {
        let page = (await import(`./Pages/${name}`)).default;

        if (page.layout === undefined) {
            page.layout = Layout;
        }

        return page;
    },
    setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
        .mixin({ methods: { route } })
        .mixin(convertFloatMoney)
        .mixin(convertMoneyFloat)
        .mixin(valorPacote)
        .mixin(convertData)
        .mixin(getPermission)
        .mixin(getRole)
        .use(plugin)
        .use(VueMask)
        .use(Notifications)
        .use(money, {precision: 4})
        .component('Link', Link)
        .component('Head', Head)
        .mount(el)
    },

    title: title => "DM - " + title
})

InertiaProgress.init({
  // The delay after which the progress bar will
  // appear during navigation, in milliseconds.
  delay: 250,

  // The color of the progress bar.
  color: '#29d',

  // Whether to include the default NProgress styles.
  includeCSS: true,

  // Whether the NProgress spinner will be shown.
  showSpinner: true,
})
