import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import AdminDashboardLayout from './Shared/AdminDashboardLayout/AdminDashboardLayout.vue'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
    let page = pages[`./Pages/${name}.vue`];
    if (name.startsWith("AdminDashboard/")) {
        page.default.layout = AdminDashboardLayout;
    }
    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})