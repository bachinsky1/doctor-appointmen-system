<template>
    <div class="rounded-lg bg-white shadow-lg mb-3 mr-3">
        <div class="bg-white rounded-t-lg p-4 flex justify-between items-center">
            <h2 class="text-base font-semibold leading-7 text-gray-900">
                <button v-if="!showEditor" class="text-blue-500 hover:text-blue-700 focus:outline-none ml-2">
                    <i class="fas fa-book-medical"></i>
                </button>
                <button v-if="showEditor" @click="showEditor = false; editingIndex = -1" class="text-blue-500 hover:text-blue-700 focus:outline-none ml-2">
                    <i class="fas fa-arrow-left"></i>
                </button> Medical notes
            </h2>
        </div>
        <div v-if="!showEditor" class="border-t border-b border-gray-200 max-h-30vh overflow-auto p-3">
            <div v-if="notes.length > 0">
                <ul class="list-none">
                    <li v-for="(note, index) in notes" :key="index" class="flex items-start justify-between border-b py-2 border-gray-300 last:border-b-0">
                        <div class="note-content flex-1 mr-2" v-html="note" v-tippy="{ content: note, placement: 'right' }"></div>
                        <div class="buttons ml-auto items-start">
                            <button v-on:click.stop="editNote(note, index)" class="text-blue-500 hover:text-blue-700 focus:outline-none">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button @click="removeNote(index)" class="text-red-500 hover:text-red-700 focus:outline-none  ml-2">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
            <div v-else>No notes here</div>
        </div>
        <div v-if="showEditor" class="border-t border-b border-gray-200 max-h-30vh overflow-auto p-3">
            <div class="grid grid-cols-1 sm:grid-cols-1">
                <TextEditor v-model="editorContent" />
            </div>
        </div>
        <div class="bg-white rounded-b-lg p-4 flex justify-center items-center">
            <div v-if="!showEditor">
                <button @click="showEditor = true; clearEditor()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                    <i class="fas fa-plus-circle"></i> Add note </button>
            </div>
            <button v-if="showEditor" @click="showEditor = false; editingIndex = -1" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mr-2">
                <i class="fas fa-times-circle"></i> Cancel </button>
            <button v-if="showEditor" @click="saveNote" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                <i class="fas fa-save"></i> Save note </button>
        </div>
    </div>
</template>

<script>

import TextEditor from "@/views/components/input/TextEditor"


export default {
    name: "MedicalNotes",
    props: [],
    components: {
        TextEditor,
    },
    data() {
        return {
            showEditor: false,
            notes: [],
            editorContent: '',
            editingIndex: -1,
        };
    },

    mounted() {

    },

    methods: {
        clearEditor() {
            this.editorContent = ''
        },
        editNote(note, index) {
            this.editorContent = note
            this.showEditor = true
            this.editingIndex = index
        },
        saveNote() {
            const newNote = this.editorContent
            if (newNote) {
                if (this.editingIndex >= 0) {
                    this.notes.splice(this.editingIndex, 1, newNote)
                } else {
                    this.notes.push(newNote)
                }
                this.showEditor = false
                this.editorContent = ''
                this.editingIndex = -1
            }
        },
        removeNote(index) {
            if (confirm('Are you sure you want to delete this note?')) {
                this.notes.splice(index, 1);
            }
        },
    },
};
</script>

<style></style>