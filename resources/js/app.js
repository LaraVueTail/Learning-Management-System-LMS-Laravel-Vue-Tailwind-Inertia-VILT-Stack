import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/vue3'
import AdminDashboardLayout from './Shared/AdminDashboardLayout/AdminDashboardLayout.vue';
import PublicPagesLayout from './Shared/PublicPagesLayout/PublicPagesLayout.vue';


createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
    let page = pages[`./Pages/${name}.vue`];
    if (name.startsWith("AdminDashboard/")) {
      page.default.layout = AdminDashboardLayout;
    }
    if (name.startsWith("Public/") || name.startsWith("StudentDashboard/")) {
      page.default.layout = PublicPagesLayout;
    }
    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component("Link", Link)
      .mount(el)
  },
})