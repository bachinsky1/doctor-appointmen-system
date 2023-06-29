<template>
    <div class="rounded-lg bg-white shadow-lg mb-3 mr-3">
        <div class="bg-white rounded-t-lg p-4">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Consultation notes</h2>
        </div>
        <div class="border-t border-b border-gray-200 max-h-20vh overflow-auto p-3">
            <div class="grid grid-cols-1 sm:grid-cols-1">
                <TextEditor />
            </div>
        </div>
        <div class="bg-white rounded-b-lg p-4 flex justify-center items-center">
            <p class="text-gray-500">Footer</p>
        </div>
    </div>
</template>

<script>

import TextEditor from "@/views/components/input/TextEditor"

export default {
    name: 'ConsultationNotes',
    props: [],
    components: {
        TextEditor
    },
}
</script>
