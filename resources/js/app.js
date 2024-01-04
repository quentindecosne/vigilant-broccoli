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



    jQuery(document).ready(function($){
        $(".master-update-select").on('change',function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault();
            var formData = {
                type: jQuery(this).data('type'),
                selected_value: jQuery(this).val(),
            };

            $.ajax({
                type: 'POST',
                url: jQuery(this).data('url'),
                data: formData,
                dataType: 'json',
                success: function (data) {
                    console.log('success');
                },
                error: function (data) {
                    console.log('error');
                    console.log(data);
                }
            });
        });
});
