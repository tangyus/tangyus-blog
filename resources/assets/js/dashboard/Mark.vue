<template>
    <div class="markdown-editor">
        <markdown-editor v-model="content" ref="markdownEditor" :configs="configs"></markdown-editor>
    </div>
</template>

<script>
    import markdownEditor from 'vue-simplemde/src/markdown-editor'

    // 基础用法
    export default {
        components: {
            markdownEditor
        },
        data () {
            return {
                content: '',
                configs: {
                    spellChecker: false // 禁用拼写检查
                }
            }
        }
    }
</script>