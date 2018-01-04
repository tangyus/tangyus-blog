<template>
    <div>
        <markdown-editor v-model="content" ref="markdownEditor" :configs="configs"></markdown-editor>

        <!-- 通过事件控制 value -->
        <!--<markdown-editor :value="content" @input="handleInput"></markdown-editor>-->

        <!-- 添加配置 -->
        <!--<markdown-editor :configs="configs"></markdown-editor>-->

        <!-- 不自动初始化 -->
        <!--<markdown-editor :autoinit="false"></markdown-editor>-->
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