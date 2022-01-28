import ToggleButton from 'vue-js-toggle-button'

Nova.booting((Vue, router) => {
    Vue.use(ToggleButton)
    Vue.component('index-toggle-field', require('./components/IndexField').default);
    Vue.component('detail-toggle-field', require('./components/DetailField').default);
    Vue.component('form-toggle-field', require('./components/FormField').default);
})
