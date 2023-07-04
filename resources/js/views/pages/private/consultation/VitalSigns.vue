<template>
    <div class="rounded-lg bg-white shadow-lg mb-3 mr-3">
        <div class="bg-white rounded-t-lg pl-4 pt-4 pb-2 flex justify-between items-center">
            <h2 class="text-base font-semibold leading-7 text-gray-900">
                <button v-if="addingVitalSigns" class="text-blue-500 hover:text-blue-700 focus:outline-none ml-2" @click="addingVitalSigns = false;">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <button v-if="!addingVitalSigns" class="text-blue-500 hover:text-blue-700 focus:outline-none ml-2">
                    <i class="fas fa-stethoscope"></i>
                </button> Vital Signs
            </h2>
        </div>
        <div v-if="!addingVitalSigns">
            <div class="flex justify-between border-b border-gray-200">
                <button :class="{ 'bg-blue-500 text-white': activeTab === 'today' }" class="w-1/2 py-1 focus:outline-none" @click="activeTab = 'today'"> Today </button>
                <button :class="{ 'bg-blue-500 text-white': activeTab === 'history' }" class="w-1/2 py-1 focus:outline-none" @click="activeTab = 'history'"> History </button>
            </div>
            <div class="border-t border-b border-gray-200 overflow-auto p-3">
                <div v-if="activeTab === 'today'">Today's vital signs</div>
                <div v-else>History of vital signs</div>
            </div>
            <div class="bg-white rounded-b-lg p-4 flex justify-center items-center">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md focus:outline-none" @click="addingVitalSigns = true"> Add vital signs </button>
            </div>
        </div>
        <div v-else>
            <ul class="border-t border-b border-gray-200 overflow-auto p-3">
                <li>Heartbeat</li>
                <li>Temperature</li>
                <li>Pressure</li>
                <li>Breathing rate</li>
                <li>Peak flow</li>
                <li>Saturation</li>
                <li>PT</li>
                <li>Glucose</li>
                <li>HbA1c</li>
            </ul>
            <div class="bg-white rounded-b-lg p-4 flex justify-center items-center">
                <button class="bg-gray-500 text-white px-4 py-2 rounded-md focus:outline-none" @click="addingVitalSigns = false"> Cancel </button>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md focus:outline-none ml-2" @click="saveVitalSigns"> Save </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'VitalSigns',
    props: [],
    data() {
        return {
            activeTab: 'today',
            addingVitalSigns: false,
        };
    },
    methods: {
        saveVitalSigns() {

            this.addingVitalSigns = false
        },
    },
}
</script>