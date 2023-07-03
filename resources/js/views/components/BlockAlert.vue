<template>
    <div>
        <div v-for="(alert, index) in alerts" :key="index">
            <div v-if="alert.show" class="fixed inset-0 z-50 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end" @click="closeAlert(index)" >
                
                    <div class="bg-gray-100 rounded-lg max-w-sm w-full shadow-lg rounded-lg pointer-events-auto" :style="{ marginTop: (index * 85) + 'px' }">
                        <div class="rounded-lg border-1 shadow-xs overflow-hidden" >
                            <div class="p-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg v-if="alert.type === 'success'" class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg v-else class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3 w-0 flex-1 pt-0.5">
                                        <p v-if="alert.type === 'success'" class="text-sm leading-5 font-medium text-gray-900">
                                            {{ alert.message || 'Успешно!' }}
                                        </p>
                                        <p v-else class="text-sm leading-5 font-medium text-gray-900">
                                            {{ alert.message || 'Ошибка!' }}
                                        </p>
                                        <p v-if="alert.description" class="mt-1 text-sm leading-5 text-gray-500">
                                            {{ alert.description }}
                                        </p>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>

import { reactive } from 'vue';

export default {
    data() {
        return {
            alerts: reactive([]),
        };
    },
    methods: {
        addAlert(alert) {
            this.alerts.push(alert);
        },
        closeAlert(index) {
            this.alerts[index].show = false;
            this.alerts.splice(index, 1);
        },
    },
};
</script>

