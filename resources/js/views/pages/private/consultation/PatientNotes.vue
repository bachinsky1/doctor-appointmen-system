<template>
    <div class="rounded-lg bg-white shadow-lg mb-3 mr-3">
        <div class="bg-white rounded-t-lg p-4 flex justify-between items-center">
            <h2 class="text-base font-semibold leading-7 text-gray-900">
                <button v-if="!showEditor" class="text-blue-500 hover:text-blue-700 focus:outline-none ml-2">
                    <i class="fas fa-book-medical"></i>
                </button>
                <button v-if="showEditor" @click="showEditor = false" class="text-blue-500 hover:text-blue-700 focus:outline-none ml-2">
                    <i class="fas fa-arrow-left"></i>
                </button> Patient notes
            </h2>
        </div>
        <div v-if="!showEditor" class="border-t border-b border-gray-200 max-h-20vh overflow-auto p-3">
            <div v-if="notes.length > 0">
                <ul class="list-disc list-inside">
                    <li v-for="(note, index) in notes" :key="index">{{ note }}</li>
                </ul>
            </div>
            <div v-else>No notes here</div>
        </div>
        <div v-if="showEditor" class="border-t border-b border-gray-200 max-h-20vh overflow-auto p-3">
            <div class="grid grid-cols-1 sm:grid-cols-1">
                <TextEditor />
            </div>
        </div>
        <div class="bg-white rounded-b-lg p-4 flex justify-center items-center">
            <div v-if="!showEditor">
                <button @click="showEditor = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                    <i class="fas fa-plus-circle"></i> Add note </button>
            </div>
            <button v-if="showEditor" @click="showEditor = false" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mr-2">
                <i class="fas fa-times-circle"></i> Cancel </button>
            <button v-if="showEditor" @click="saveNote" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                <i class="fas fa-save"></i> Save note </button>
        </div>
    </div>
</template>

<script>
import TextEditor from "@/views/components/input/TextEditor";

export default {
    name: "PatientNotes",
    props: [],
    components: {
        TextEditor,
    },
    data() {
        return {
            showEditor: false,
            notes: [],
        };
    },
    methods: {
        saveNote() {
            const newNote = this.$refs.textEditor.getContent();
            if (newNote) {
                this.notes.push(newNote);
                this.showEditor = false;
            }
        },
    },
};
</script>

<style>
ul li {
    margin-bottom: 0.5rem;
}
</style>