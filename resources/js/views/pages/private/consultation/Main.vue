<template>
    <Page :title="page.title" :actions="page.actions" @action="onAction" id="consultation">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/3">
                <MedicalNotes id="medicalNotes"/>
                <ConsultationNotes id="consultationNotes"/>
                <PatientNotes />
                <PreviousConsultations id="previousConsultations" />
            </div>
            <div class="w-full md:w-1/3">
                <Problems />
                <VitalSigns />
                <BloodGroup />
                <Laboratory />
                <CovidCertificates />
            </div>
            <div class="w-full md:w-1/3">
                <Letter />
                <MedicalDocument />
                <Prescription />
                <AttachDocument />
            </div>
        </div>
    </Page>
</template>

<script>
import { defineComponent, reactive } from "vue"
import { trans } from "@/helpers/i18n"
import { getResponseError } from "@/helpers/api"
import { useConsultationStore } from "@/stores"
import { useAlertStore } from "@/stores"

import Page from "@/views/layouts/Page"
import Form from "@/views/components/Form"
import MedicalNotes from "@/views/pages/private/consultation/MedicalNotes" 
import VitalSigns from "@/views/pages/private/consultation/VitalSigns"
import Problems from "@/views/pages/private/consultation/Problems"
import ConsultationNotes from "@/views/pages/private/consultation/ConsultationNotes"
import PatientNotes from "@/views/pages/private/consultation/PatientNotes"
import Laboratory from "@/views/pages/private/consultation/Laboratory"
import Letter from "@/views/pages/private/consultation/Letter"
import MedicalDocument from "@/views/pages/private/consultation/MedicalDocument"
import Prescription from "@/views/pages/private/consultation/Prescription"
import AttachDocument from "@/views/pages/private/consultation/AttachDocument"
import PreviousConsultations from "@/views/pages/private/consultation/PreviousConsultations"
import CovidCertificates from "@/views/pages/private/consultation/CovidCertificates"
import BloodGroup from "@/views/pages/private/consultation/BloodGroup"

import ConsultationService from "@/services/ConsultationService"

export default defineComponent({
    components: {
        Page,
        Form,
        MedicalNotes, 
        VitalSigns,
        Problems,
        ConsultationNotes,
        PatientNotes,
        Laboratory,
        Letter,
        MedicalDocument,
        Prescription,
        AttachDocument,
        PreviousConsultations,
        CovidCertificates,
        BloodGroup,
    },

    props: {
        appointmentId: {
            type: String,
            required: true,
        },
    },

    data() {
        return {
            consultation: {},
        }
    },

    mounted() { 

    },

    methods: {

    },

    setup(props) {
        const appointmentId = props.appointmentId
        const consultationStore = useConsultationStore()
        const alertStore = useAlertStore()
        const consultationService = new ConsultationService()

        const page = reactive({
            id: "consultation",
            title: trans("global.pages.consultation"),
            filters: false,
            actions: [{
                id: "close_consultation",
                name: trans("global.buttons.close_consultation"),
                icon: "fa fa-close",
                type: "submit",
            }]
        })

        let consultationData = {}

        const activateConsultation = async () => {
            try {
                const result = await consultationService.activate(appointmentId)
                consultationData = result.data
                if (consultationData.consultation.is_opened === 0) {
                    removeCloseButton()
                }
                consultationStore.setCurrentConsultation(consultationData.consultation)
            } catch (error) {
                alertStore.error(getResponseError(error))
            }
        }

        activateConsultation()

        const closeConsultation = async () => {

            try {
                const result = await consultationService.close({ public_id: consultationData.consultation.public_id })
                if (result.status === 200) {
                    alertStore.success(result.data.message)
                    removeCloseButton()
                } else {
                    alertStore.error(result.data.message)
                }
            } catch (error) {
                alertStore.error(getResponseError(error))
            }
        }

        const removeCloseButton = () => {
            const index = page.actions.findIndex(action => action.id === "close_consultation")
            if (index !== -1) {
                page.actions.splice(index, 1)
            }
        }

        function onAction(data) {
            switch (data.action.id) {
                case "close_consultation":
                    closeConsultation()
                    break
            }
        }

        return {
            trans,
            consultationStore,
            consultationService,
            page,
            onAction,
        }
    },
})
</script> 