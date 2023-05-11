import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
    app.component('index-toggle-field', IndexField)
    app.component('detail-toggle-field', DetailField)
    app.component('form-toggle-field', FormField)
})
