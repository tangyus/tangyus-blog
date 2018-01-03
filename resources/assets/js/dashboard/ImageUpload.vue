<template>
    <div id="image-upload">
        <el-upload
                class="upload-demo"
                ref="upload"
                action="/upload"
                :headers="headers"
                :before-upload="uploadFile"
                :on-success="successHandle"
                :on-error="errorHandle"
                :limit="1"
                :file-list="fileList"
                :on-exceed="handleExceed"
                :auto-upload="false"
                list-type="picture"
                name="image">
            <el-button slot="trigger" size="small" type="primary">选取文件</el-button>
            <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUpload">上传</el-button>
            <div slot="tip" class="el-upload__tip">只能上传jpg/jpeg/png文件，且不超过500KB</div>
        </el-upload>
        <el-alert
                v-if="uploadErrorMessage.length > 0"
                v-for="item in uploadErrorMessage"
                title=""
                type="error">
            {{item}}
        </el-alert>
    </div>
</template>

<script>
    export default {
        props: {
            link: {
                type: Object
            },
            fileList: {
                type: Array
            }
        },
        data() {
            return {
                uploadErrorMessage: []
            }
        },
        computed: {
            headers() {
                return {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
        },
        methods: {
            submitUpload() {
                this.$refs.upload.submit();
            },
            uploadFile(file) {
                if (file.size > 500 * 1024) {
                    this.$message({
                        message: '请上传小于500KB的图片',
                        type: 'error',
                        showClose: true
                    });
                    return false;
                }
                if (file.type != 'image/jpeg') {
                    this.$message({
                        message: '请上传jpg/jpeg/png格式的图片',
                        type: 'error',
                        showClose: true
                    });
                    return false;
                }
            },
            handleExceed() {
                this.$message({
                    message: '最多只能上传一张图片',
                    type: 'error',
                    showClose: true
                });
            },
            successHandle(response, file, fileList) {
                if (response.success) {
                    this.link.link_image = response.path;
                    this.uploadErrorMessage = [];
                    this.fileList = [{
                        'name': file.name,
                        'url': file.url
                    }];
                } else {
                    this.uploadErrorMessage = response.message.image;
                    this.fileList = [];
                }
            },
            errorHandle(err, file, fileList) {
                this.$message({
                    message: err,
                    type: 'error',
                    showClose: true
                });
            }
        }
    }
</script>

<style lang="scss">
    .el-alert {
        margin: 5px 0;
    }
    input[type="file"] {
        display: none;
    }
</style>