

<template>
    <Page title="Consultation">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/3">
                <MedicalNotes />
                <ConsultationNotes />
                <PatientNotes />
                <MedicalHistory />
                <PreviousConsultations />
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
import { defineComponent } from 'vue'
import { trans } from "@/helpers/i18n"
import Page from "@/views/layouts/Page"
import MedicalNotes from '@/views/pages/private/consultation/MedicalNotes'
import MedicalHistory from '@/views/pages/private/consultation/MedicalHistory'
import VitalSigns from '@/views/pages/private/consultation/VitalSigns'
import Problems from '@/views/pages/private/consultation/Problems'
import ConsultationNotes from '@/views/pages/private/consultation/ConsultationNotes'
import PatientNotes from '@/views/pages/private/consultation/PatientNotes'
import Laboratory from '@/views/pages/private/consultation/Laboratory'
import Letter from '@/views/pages/private/consultation/Letter'
import MedicalDocument from '@/views/pages/private/consultation/MedicalDocument'
import Prescription from '@/views/pages/private/consultation/Prescription'
import AttachDocument from '@/views/pages/private/consultation/AttachDocument'
import PreviousConsultations from '@/views/pages/private/consultation/PreviousConsultations'
import CovidCertificates from '@/views/pages/private/consultation/CovidCertificates'
import BloodGroup from '@/views/pages/private/consultation/BloodGroup'

export default defineComponent({
    components: {
        Page,
        MedicalNotes,
        MedicalHistory,
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
    setup() {
        return {
            trans
        }
    }
});
</script>

