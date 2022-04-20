import IndexField from './components/IndexField';
import DetailField from './components/DetailField';
// import FormField from './components/FormField';

Nova.booting((app, store) => {
    app.component('index-field-progressbar', IndexField);
    app.component('detail-field-progressbar', DetailField);
});
