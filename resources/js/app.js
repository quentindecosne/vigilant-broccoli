import './bootstrap';

import $ from 'jquery';
import Alpine from 'alpinejs';
import flatpickr from "flatpickr";

window.jQuery = window.$ = $;
window.Alpine = Alpine;
window.flatpickr = flatpickr

import './../../node_modules/flatpickr/dist/flatpickr.min.css';

import './../../vendor/power-components/livewire-powergrid/dist/powergrid'
import './../../vendor/power-components/livewire-powergrid/dist/powergrid.css'

Alpine.start();



