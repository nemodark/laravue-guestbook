import VueRouter from 'vue-router';

import GuestsComponent from './components/Guests.vue';
import AddGuestComponent from './components/AddGuest.vue';
import EditGuestComponent from './components/EditGuest.vue';

const routes = [
    {
        path: '/',
        name: 'guests',
        component: GuestsComponent,
    },
    {
        path: '/addGuest',
        name: 'addGuest',
        component: AddGuestComponent,
    },
    {
        path: '/editGuest/:id',
        name: 'editGuest',
        component: EditGuestComponent,
    }
];

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
});

export default router;