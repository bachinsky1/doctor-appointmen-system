<template> 
    <editor :api-key="apiKey" :init="{ plugins: 'wordcount lists code'}"/>
</template>

<script>
import Editor from '@tinymce/tinymce-vue'

export default {
    name: 'TextEditor',
    components: {
        'editor': Editor
    },
    data() {
        return {
            apiKey: '1gs5mlv522cwx6vbeq130yzt3e9mqy2nzjfq5f91f8nk49c9'
        }
    },
    
}
</script> 