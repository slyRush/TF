const axios = require('axios'); //axios
const routes = require('../../public/js/fos_js_routes.json');
//import Routing from '../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';
const Routing = require('../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router');

Routing.setRoutingData(routes);

const form = document.querySelector('#contact-form');
//const url = form.getAttribute('action');
console.log(Routing.generate('contact_us_email_new'));

function onSubmitContactForm(event)
{
    console.log('mandalo ato ve');
    event.preventDefault();
    axios.post(url, {})
        .then(function (response) {
            //document.querySelector('#contact').innerHTML = response.data.content;
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        });
}

form.querySelector('#submit_contact_form').addEventListener('click', onSubmitContactForm);