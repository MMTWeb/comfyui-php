import './bootstrap';
import axios from 'axios';

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('generate-form');

    if (!form) return;

    // Set CSRF token for Axios
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    if (token) {
        axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
    }

    form.addEventListener('submit', function (e) {

        e.preventDefault();

        const route = form.dataset.route;

        document.getElementById('generate-button')?.classList.add('d-none');
        document.getElementById('loader')?.classList.remove('d-none');
        document.getElementById('result')?.classList.add('d-none');

        const formData = new FormData();

        // Add text/number inputs
        formData.append('prompt', form.prompt.value);
        formData.append('height', parseInt(form.height.value));
        formData.append('width', parseInt(form.width.value));
        formData.append('steps', parseInt(form.steps.value));
        formData.append('cfg', parseFloat(form.cfg.value));
        formData.append('seed', form.seed.value ? parseInt(form.seed.value) : '');
        formData.append('model', form.model.value);
        formData.append('clip-one', form.clip_one.value);
        formData.append('clip-two', form.clip_two.value);
        formData.append('negative-prompt', form["negative-prompt"].value);

        axios.post(route, formData)
        .then(response => {

            const img = document.getElementById('generated-image');
            const link = document.getElementById('download-link');

            if (img && link && response.data.base64_image) {
                img.src = response.data.base64_image;
                link.href = response.data.base64_image;
                document.getElementById('result').classList.remove('d-none');
            }

        })
        .catch(err => {
            alert('Error generating image: ' + (err.response?.data?.error || err.message));
        })
        .finally(() => {
            document.getElementById('loader')?.classList.add('d-none');
            document.getElementById('generate-button')?.classList.remove('d-none');
        });

    });

});