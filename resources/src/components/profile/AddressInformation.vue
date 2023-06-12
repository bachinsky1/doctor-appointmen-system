<template>
    <div class="col">
        <div class="card mb-5">
            <div class="card-header">Address Information</div>
            <div class="card-body">
                <form class="row g-3" id="contactForm" ref="contactForm">
                    <input type="hidden" name="_token" :value="csrfToken">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary"> Update </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script lang="ts">

export default {
    name: 'AddressInformation',
    components: {

    },
    props: [
        'message',
    ],
    data() {
        return {
            contactForm: {
                isFormChanged: false,
            },
            csrfToken: '',
            formMessage: '',
            formMessageTimeout: 4000,
            formMessageClass: ''
        }
    }
}
</script>